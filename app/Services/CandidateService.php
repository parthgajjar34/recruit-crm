<?php

/**
 * Laravel Service Class
 * PHP version 8.1
 *
 * @category App\Services
 * @package  App\Services
 * @author   Parth Gajjar<parthgajjar34@gmail.com>
 */

namespace App\Services;

use App\Contracts\CandidateInterface;
use App\Enums\GenderEnum;
use App\Models\Candidate;
use App\Traits\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CandidateService
 *
 * @category App\Services
 * @package  App\Services
 * @author   Parth Gajjar<parthgajjar34@gmail.com>
 */
class CandidateService implements CandidateInterface
{
    use Common;

    /**
     * @var Candidate
     */
    private $candidate;
    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * CandidateService constructor
     * @param Candidate $candidate
     * @param Carbon $carbon
     */
    public function __construct(Candidate $candidate, Carbon $carbon)
    {
        $this->candidate = $candidate;
        $this->carbon = $carbon;
    }

    /**
     * Store Candidate method
     * @param $request
     * @return Candidate
     */
    public function registerCandidate($request): Candidate
    {
    //   echo "<pre>";print_R($request->file());exit;
        if($request->file()) {
            $fileName = time().'_'.$request->resume->getClientOriginalName();
            $filePath = $request->file('resume')->store('public/storage/resume');
        }

        $dob = $request->candidate_dob;
        $timeStamp = strtotime($dob);
        $gender = ( $request->gender == GenderEnum::Male ) ? 1 : 2;
       
        return $this->candidate->create([
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'email'            => $request->email,
            'contact_number'    => $request->contact_number,
            'gender'            => $request->gender,
            'specialization'    => $request->specialization,
            'work_ex_year'      => $request->work_ex_year,
            'address'           => $request->address,
            'candidate_dob'     => $timeStamp,
            'resume'            => $filePath
        ]);
    }

    public function listCandidate(){
        return $this->candidate::paginate(10);
    }

    public function showCandidate($id){
        return $this->candidate::find($id);
    }

    public function searchCandidate($keyword){
       return $this->candidate::where('first_name', 'LIKE', '%'. $keyword. '%')->orWhere('last_name', 'LIKE', '%'. $keyword. '%')->paginate(10);
    }
}
