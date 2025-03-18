<?php
 
namespace App\Http\Controllers;
 
use App\DataTransferObjects\Identifier;
use App\Exceptions\CharacterNotFoundException;
use App\Repositories\CharacterRepository;
use Illuminate\View\View;
 
class CharacterController extends Controller
{
    public function __construct(
        private CharacterRepository $characterRepository,
    ) {
    }
 
    public function __invoke(Identifier $id): View
    {
        try {
            $character = $this->characterRepository->find($id);
 
            return view('characters.show', ['character' => $character]);
        } catch (CharacterNotFoundException $e) {
            abort(404);
        }
    }
}