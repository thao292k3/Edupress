<?php

namespace App\Services;

use App\Models\Section;
use App\Repositories\SectionRepository;

class SectionService
{
    protected $repo;

    public function __construct(SectionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function createSection($data)
    {
        
        $lastPosition = Section::where('course_id', $data['course_id'])
                                     ->max('position');

        
        $data['position'] = ($lastPosition === null) ? 0 : $lastPosition + 1;

        return $this->repo->create($data);
    }

    public function updateSection($id, $data)
    {
        $section = $this->repo->find($id);
        return $this->repo->update($section, $data);
    }

    public function deleteSection($id)
    {
        $section = $this->repo->find($id);
        return $this->repo->delete($section);
    }
}
