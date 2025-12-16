<?php

namespace App\Repositories;

use App\Models\Section;
use App\Models\Sections;

class SectionRepository
{
    public function find($id)
    {
        return Section::with('lessons')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Section::create($data);
    }

    public function update(Section $section, array $data)
    {
        $section->update($data);
        return $section;
    }

    public function delete(Section $section)
    {
        return $section->delete();
    }
}
