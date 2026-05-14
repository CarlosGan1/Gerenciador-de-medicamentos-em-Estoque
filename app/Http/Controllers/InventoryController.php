<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;

class InventoryController extends Controller
{
    /**
     * Mostra a lista de medicamentos.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $medications = Medication::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('medication_id', 'LIKE', "%{$search}%")
                             ->orWhere('group', 'LIKE', "%{$search}%");
            })
            ->paginate(6);

        return view('inventory.listamedicamento', compact('medications'));
    }

    /**
     * Mostra o formulário de criação de novo medicamento.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Armazena um novo medicamento no banco de dados.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'medication_id' => 'required|string|max:255|unique:medications',
            'type' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'ideal_quantity' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
            'expiration_date' => 'nullable|date',
        ]);

        // Verifica duplicidade (nome + tipo + grupo)
        $exists = Medication::where('name', $validatedData['name'])
            ->where('type', $validatedData['type'])
            ->where('group', $validatedData['group'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'Este medicamento já está cadastrado com o mesmo tipo e grupo.'])->withInput();
        }

        Medication::create($validatedData);

        return redirect()->route('inventory.index')->with('success', 'Medicamento cadastrado com sucesso.');
    }

    /**
     * Mostra o formulário de edição de um medicamento.
     */
    public function edit($id)
    {
        $medication = Medication::findOrFail($id);

        return view('inventory.edit', compact('medication'));
    }

    /**
     * Atualiza um medicamento no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $medication = Medication::findOrFail($id);

        $validatedData = $request->validate([
            'name'             => 'required|string|max:255',
            'medication_id'    => 'required|string|max:255|unique:medications,medication_id,' . $medication->id,
            'type'             => 'required|string|max:255',
            'group'            => 'required|string|max:255',
            'quantity'         => 'required|integer|min:0',
            'ideal_quantity'   => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
            'expiration_date'  => 'nullable|date',
        ]);

        $medication->update($validatedData);

        return redirect()->route('inventory.index')->with('success', 'Medicamento atualizado com sucesso.');
    }

    /**
     * Remove um medicamento do banco de dados.
     */
    public function destroy($id)
    {
        $medication = Medication::findOrFail($id);
        $medication->delete();

        return redirect()->route('inventory.index')->with('success', 'Medicamento excluído com sucesso.');
    }
}