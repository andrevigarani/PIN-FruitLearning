<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class FileController extends Controller
{
    use ValidatesRequests;
    public function uploadSVM(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv|max:2048',
        ]);

        try {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/svm', $filename);

            $processedFilePath = $this->processSVM($path);

            return redirect()->route('svm.show', ['filename' => basename($processedFilePath)]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Erro ao processar o arquivo. Insira um arquivo válido.']);
        }
    }

    private function processSVM($path)
    {
        // Processamento do arquivo e armazenamento do resultado
        $inputFilePath = storage_path('app/' . $path);
        $modelFilePath = storage_path('app/python/svm_model.pkl'); // Assumindo que o modelo está armazenado aqui
        $outputFilePath = storage_path('app/processed/svm_output_' . basename($path));

        // Execute o script Python
        $process = new Process(['python3', base_path('scripts/process.py'), $inputFilePath, $modelFilePath, $outputFilePath]);
        $process->run();

        // Verifique se houve algum erro durante a execução
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $outputFilePath;
    }

    public function showSVMDownload($filename)
    {
        return view('svm.download', ['filename' => $filename]);
    }

    public function uploadDecisionTree(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv|max:2048',
        ]);

        try {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/decision-tree', $filename);

            $processedFilePath = $this->processDecisionTree($path);

            return redirect()->route('decision-tree.show', ['filename' => basename($processedFilePath)]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Erro ao processar o arquivo. Insira um arquivo válido.']);
        }
    }

    private function processDecisionTree($path)
    {
        // Processamento do arquivo e retorno do resultado
        $inputFilePath = storage_path('app/' . $path);
        $modelFilePath = storage_path('app/python/decision_tree_model.pkl'); // Assumindo que o modelo está armazenado aqui
        $outputFilePath = storage_path('app/processed/dtree_output_' . basename($path));

        // Execute o script Python
        $process = new Process(['python3', base_path('scripts/process.py'), $inputFilePath, $modelFilePath, $outputFilePath]);
        $process->run();

        // Verifique se houve algum erro durante a execução
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $outputFilePath;
    }

    public function showDecisionTreeDownload($filename)
    {
        return view('dtree.download', ['filename' => $filename]);
    }

    public function downloadFile($filename)
    {
        $filePath = 'processed/' . $filename;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        } else {
            return redirect()->back()->withErrors(['file' => 'Arquivo não encontrado.']);
        }
    }
}
