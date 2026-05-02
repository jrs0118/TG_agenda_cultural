<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Categoria;
use App\Models\Ubicacion;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReporteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $categorias = Categoria::all();
        $ubicaciones = Ubicacion::all();
        
        $totalEventos = Evento::count();
        $eventosFuturos = Evento::where('fecha', '>=', Carbon::today())->count();
        $eventosPasados = Evento::where('fecha', '<', Carbon::today())->count();
        $eventosEsteMes = Evento::whereMonth('fecha', Carbon::now()->month)->count();
        
        $comunas = [
            '1' => 'Popular', '2' => 'Santa Cruz', '3' => 'Manrique', '4' => 'Aranjuez',
            '5' => 'Castilla', '6' => 'Doce de Octubre', '7' => 'Robledo', '8' => 'Villa Hermosa',
            '9' => 'Buenos Aires', '10' => 'La Candelaria', '11' => 'Laureles - Estadio',
            '12' => 'La América', '13' => 'San Javier', '14' => 'El Poblado', '15' => 'Guayabal',
            '16' => 'Belén', '50' => 'San Sebastián de Palmitas', '60' => 'San Cristóbal',
            '70' => 'Altavista', '80' => 'San Antonio de Prado', '90' => 'Santa Elena',
        ];
        
        $ultimosReportes = Reporte::with('usuario')->orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('reportes.index', compact(
            'categorias', 'ubicaciones', 'comunas', 
            'totalEventos', 'eventosFuturos', 'eventosPasados', 
            'eventosEsteMes', 'ultimosReportes'
        ));
    }

    public function generarListado(Request $request)
    {
        $request->validate([
            'tipo_reporte' => 'required|in:listado'
        ]);

        $eventos = $this->aplicarFiltros($request);
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Listado de Eventos');
        
        // Encabezados
        $sheet->setCellValue('A1', 'LISTADO DE EVENTOS - AGENDA CULTURAL');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A3', 'ID');
        $sheet->setCellValue('B3', 'Nombre');
        $sheet->setCellValue('C3', 'Fecha');
        $sheet->setCellValue('D3', 'Hora');
        $sheet->setCellValue('E3', 'Categoría');
        $sheet->setCellValue('F3', 'Lugar');
        $sheet->setCellValue('G3', 'Dirección');
        $sheet->setCellValue('H3', 'Comuna');
        
        $sheet->getStyle('A3:H3')->getFont()->setBold(true);
        $sheet->getStyle('A3:H3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('0033A0');
        $sheet->getStyle('A3:H3')->getFont()->getColor()->setRGB('FFFFFF');
        
        $fila = 4;
        foreach ($eventos as $evento) {
            $sheet->setCellValue('A' . $fila, $evento->id_evento);
            $sheet->setCellValue('B' . $fila, $evento->nombre_evento);
            $sheet->setCellValue('C' . $fila, Carbon::parse($evento->fecha)->format('d/m/Y'));
            $sheet->setCellValue('D' . $fila, Carbon::parse($evento->hora)->format('g:i A'));
            $sheet->setCellValue('E' . $fila, $evento->categoria->nombre_categoria ?? 'N/A');
            $sheet->setCellValue('F' . $fila, $evento->ubicacion->nombre_lugar ?? 'N/A');
            $sheet->setCellValue('G' . $fila, $evento->ubicacion->direccion ?? 'N/A');
            $sheet->setCellValue('H' . $fila, $this->getNombreComuna($evento->ubicacion->comuna ?? null));
            $fila++;
        }
        
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $nombreArchivo = 'listado_eventos_' . Carbon::now()->format('Ymd_His') . '.xlsx';
        $rutaArchivo = 'reportes/' . $nombreArchivo;
        
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $contenido = ob_get_clean();
        
        Storage::disk('public')->put($rutaArchivo, $contenido);
        
        Reporte::create([
            'nombre_reporte' => 'Listado de Eventos',
            'tipo_reporte' => 'listado',
            'filtros_aplicados' => $request->except('_token', 'tipo_reporte'),
            'ruta_archivo' => $rutaArchivo,
            'id_usuario' => Auth::id(),
            'fecha_generacion' => Carbon::now()
        ]);
        
        return redirect()->route('reportes.index')->with('success', 'Reporte generado exitosamente.');
    }

    public function generarResumen(Request $request)
    {
        $request->validate([
            'tipo_reporte' => 'required|in:resumen'
        ]);
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Resumen Ejecutivo');
        
        $sheet->setCellValue('A1', 'RESUMEN EJECUTIVO - AGENDA CULTURAL');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A3', 'Métrica');
        $sheet->setCellValue('B3', 'Valor');
        $sheet->getStyle('A3:B3')->getFont()->setBold(true);
        $sheet->getStyle('A3:B3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('0033A0');
        $sheet->getStyle('A3:B3')->getFont()->getColor()->setRGB('FFFFFF');
        
        $totalEventos = Evento::count();
        $eventosFuturos = Evento::where('fecha', '>=', Carbon::today())->count();
        $totalCategorias = Categoria::count();
        $totalUbicaciones = Ubicacion::count();
        
        $datos = [
            ['Total de Eventos', $totalEventos],
            ['Eventos Futuros', $eventosFuturos],
            ['Total de Categorías', $totalCategorias],
            ['Total de Ubicaciones', $totalUbicaciones],
        ];
        
        $fila = 4;
        foreach ($datos as $dato) {
            $sheet->setCellValue('A' . $fila, $dato[0]);
            $sheet->setCellValue('B' . $fila, $dato[1]);
            $fila++;
        }
        
        $nombreArchivo = 'reporte_resumen_' . Carbon::now()->format('Ymd_His') . '.xlsx';
        $rutaArchivo = 'reportes/' . $nombreArchivo;
        
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $contenido = ob_get_clean();
        
        Storage::disk('public')->put($rutaArchivo, $contenido);
        
        Reporte::create([
            'nombre_reporte' => 'Reporte Resumen Ejecutivo',
            'tipo_reporte' => 'resumen',
            'filtros_aplicados' => $request->except('_token', 'tipo_reporte'),
            'ruta_archivo' => $rutaArchivo,
            'id_usuario' => Auth::id(),
            'fecha_generacion' => Carbon::now()
        ]);
        
        return redirect()->route('reportes.index')->with('success', 'Reporte resumen generado exitosamente.');
    }

    public function historial()
    {
        $reportes = Reporte::with('usuario')->orderBy('created_at', 'desc')->paginate(15);
        return view('reportes.historial', compact('reportes'));
    }

    public function descargar($id)
    {
        $reporte = Reporte::findOrFail($id);
        
        if (Auth::id() !== $reporte->id_usuario && !Auth::user()->esAdministrador()) {
            return redirect()->route('reportes.historial')->with('error', 'No tienes permiso.');
        }
        
        $rutaCompleta = storage_path('app/public/' . $reporte->ruta_archivo);
        
        if (!file_exists($rutaCompleta)) {
            return redirect()->route('reportes.historial')->with('error', 'El archivo no existe.');
        }
        
        return response()->download($rutaCompleta, $reporte->nombre_reporte . '.xlsx');
    }

    public function eliminar($id)
    {
        $reporte = Reporte::findOrFail($id);
        
        if (Auth::id() !== $reporte->id_usuario && !Auth::user()->esAdministrador()) {
            return redirect()->route('reportes.historial')->with('error', 'No tienes permiso.');
        }
        
        $rutaCompleta = storage_path('app/public/' . $reporte->ruta_archivo);
        if (file_exists($rutaCompleta)) {
            unlink($rutaCompleta);
        }
        
        $reporte->delete();
        
        return redirect()->route('reportes.historial')->with('success', 'Reporte eliminado.');
    }

    private function aplicarFiltros($request)
    {
        $query = Evento::with(['categoria', 'ubicacion']);
        
        if ($request->categoria) {
            $query->where('id_categoria', $request->categoria);
        }
        if ($request->ubicacion) {
            $query->where('id_ubicacion', $request->ubicacion);
        }
        if ($request->fecha_desde) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }
        if ($request->fecha_hasta) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }
        if ($request->comuna) {
            $query->whereHas('ubicacion', function($q) use ($request) {
                $q->where('comuna', $request->comuna);
            });
        }
        
        return $query->orderBy('fecha', 'desc')->get();
    }

    private function getNombreComuna($comunaId)
    {
        $comunas = [
            '1' => 'Popular', '2' => 'Santa Cruz', '3' => 'Manrique', '4' => 'Aranjuez',
            '5' => 'Castilla', '6' => 'Doce de Octubre', '7' => 'Robledo', '8' => 'Villa Hermosa',
            '9' => 'Buenos Aires', '10' => 'La Candelaria', '11' => 'Laureles - Estadio',
            '12' => 'La América', '13' => 'San Javier', '14' => 'El Poblado', '15' => 'Guayabal',
            '16' => 'Belén', '50' => 'San Sebastián de Palmitas', '60' => 'San Cristóbal',
            '70' => 'Altavista', '80' => 'San Antonio de Prado', '90' => 'Santa Elena',
        ];
        return $comunas[$comunaId] ?? 'No especificada';
    }
}