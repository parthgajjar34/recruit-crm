<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CandidateFormRequest;
use App\Models\Candidate;
use App\Services\CandidateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    /**
     * @var CandidateService
     */
    private $candidateService;
    /**
     * @var Candidate
     */
    private $candidate;

    /**
     * CandidateController constructor
     * @param CandidateService $candidateService
     * @param Candidate $candidate
     *
     * @author Parth Gajjar
     */
    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    /**
     * Apply a fresh Candidate
     * @param CandidateFormRequest $request
     * @return JsonResponse
     */
    public function store(CandidateFormRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->candidateService->registerCandidate(
                $request
            );
            DB::commit();
            return $this->successMsg('Candidate added successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorMsg($exception->getMessage());
        }
    }

    public function list(Request $request)
    {
        
        try {
            $candidate = $this->candidateService->listCandidate();
            
            return $candidate;
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorMsg($exception->getMessage());
        }
    }

    public function show($id)
    {
        
        try {
            $candidate = $this->candidateService->showCandidate($id);
            
            return $candidate;
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorMsg($exception->getMessage());
        }
    }    

    public function search($keyword)
    {
        
        try {
            $candidate = $this->candidateService->searchCandidate($keyword);
            
            return $candidate;
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorMsg($exception->getMessage());
        }
    }   
}
