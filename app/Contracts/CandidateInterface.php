<?php

namespace App\Contracts;

use App\Models\Candidate;

interface CandidateInterface
{
    /**
     * Method definition of candidateregistration
     * @param int $request
     * @return Candidate
     */
    public function registerCandidate($request): Candidate;
    
    /**
     * Method definition for list candidate
     */
    public function listCandidate();

     /**
     * Method definition for list candidate
     */
    public function showCandidate($id);

    /**
    * Method definition for list candidate
    */
   public function searchCandidate($keyword);

}
