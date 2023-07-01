<?php

namespace App\Services\Questions;

use App\Http\Resources\StudentAttempt\StudentAttemptResource;
use App\Models\Question;
use App\Models\StudentAttempt;
use App\Repositories\Questions\QuestionsRepository;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\StudentAttempt\StudentAttemptRepository;
use App\Repositories\Subject\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ApartmentGetter
 * @package App\Services\Apartment
 */
class AllocateRandomQuestionStudent
{
    /**
     * @var QuestionsRepository, StudentAttemptsRepository, StudentsRepository
     */
    protected $questionRepository, $studentAttemptRepository,
        $studentRepository, $subjectRepository, $settingRepository;

    /**
     * StudentGetter constructor.
     * @param QuestionsRepository $questionRepository
     */
    public function __construct(
        QuestionsRepository $questionRepository,
        StudentAttemptRepository $studentAttemptRepository,
        StudentRepository $studentRepository,
        SubjectRepository $subjectRepository,
        SettingRepository $settingRepository,
    ) {
        $this->questionRepository = $questionRepository;
        $this->studentAttemptRepository = $studentAttemptRepository;
        $this->studentRepository = $studentRepository;
        $this->subjectRepository = $subjectRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function storeRandomQuestionsForStudents($student_id)
    {

        $students = $this->studentRepository->findById($student_id);
        $questions = $this->questionRepository->getAll()->where('subject_id', $students->subject_id);
        $subject = $this->subjectRepository->findById($students->subject_id);

        $settings  =  $this->settingRepository->findByFirst('created_by', $subject->created_by, '=');


        $questions = $questions->shuffle();

        $allocatedQuestions = $questions->splice(0, $settings->number_of_question_per_student);
        foreach ($allocatedQuestions as $allocatedQuestion) {
            $data['student_id'] = $students->id;
            $data['question_id'] = $allocatedQuestion->id;
            $attempt = $this->studentAttemptRepository->create($data);
        }


        return $questions;
    }
}
