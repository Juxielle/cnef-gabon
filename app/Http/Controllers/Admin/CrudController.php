<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Contrôleur CRUD générique réutilisé par toutes les ressources de contenu
 * du back-office. Chaque sous-classe déclare seulement : le modèle, les
 * colonnes du tableau, les champs du formulaire et les règles de validation.
 */
abstract class CrudController extends Controller
{
    /** @var class-string<Model> */
    protected string $model;

    protected string $title;

    protected string $routeBase; // ex: admin.acteurs

    protected string $orderColumn = 'ordre';

    /** Colonnes affichées dans le tableau : ['champ' => 'Libellé'] */
    protected array $columns = [];

    /** Définition des champs du formulaire de création/édition */
    abstract protected function fields(?Model $item = null): array;

    /** Règles de validation Laravel */
    abstract protected function rules(?Model $item = null): array;

    public function index(): View
    {
        $items = $this->model::query()->orderBy($this->orderColumn)->paginate(15);

        return view('admin.crud.index', [
            'title' => $this->title,
            'routeBase' => $this->routeBase,
            'columns' => $this->columns,
            'items' => $items,
        ]);
    }

    public function create(): View
    {
        return view('admin.crud.form', [
            'title' => $this->title,
            'routeBase' => $this->routeBase,
            'item' => null,
            'fields' => $this->fields(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, $this->rules());

        $this->model::create($data);

        return redirect()->route($this->routeBase.'.index')->with('success', $this->title.' créé(e) avec succès.');
    }

    public function edit(int $id): View
    {
        $item = $this->model::findOrFail($id);

        return view('admin.crud.form', [
            'title' => $this->title,
            'routeBase' => $this->routeBase,
            'item' => $item,
            'fields' => $this->fields($item),
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $item = $this->model::findOrFail($id);
        $data = $this->validated($request, $this->rules($item));

        $item->update($data);

        return redirect()->route($this->routeBase.'.index')->with('success', $this->title.' mis(e) à jour avec succès.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->model::findOrFail($id)->delete();

        return redirect()->route($this->routeBase.'.index')->with('success', $this->title.' supprimé(e).');
    }

    /**
     * Valide la requête et décode les champs JSON (saisis en texte brut
     * dans le formulaire) vers un tableau PHP avant enregistrement.
     */
    protected function validated(Request $request, array $rules): array
    {
        $data = $request->validate($rules);

        foreach ($this->fields() as $field) {
            if (($field['type'] ?? null) === 'json' && array_key_exists($field['name'], $data)) {
                $data[$field['name']] = json_decode($data[$field['name']], true) ?? [];
            }
            if (($field['type'] ?? null) === 'checkbox') {
                $data[$field['name']] = $request->boolean($field['name']);
            }
        }

        return $data;
    }
}
