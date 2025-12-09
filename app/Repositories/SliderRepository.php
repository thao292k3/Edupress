<?php

namespace App\Repositories;


use App\Models\Slider;
use \App\Traits\FileUploadTrait;

class SliderRepository
{
    use FileUploadTrait;

    public function saveSlider(array $data, $image = null)
    {
        if ($image) {
            $data['image'] = $this->uploadFile($image, 'slider');
        }

        return Slider::create($data);
    }

    public function updateSlider(array $data, $image = null, $id)
    {
        $slider = Slider::findOrFail($id);

        if ($image) {
            $data['image'] = $this->uploadFile($image, 'slider', $slider->image);
        }

        $slider->update($data);
        return $slider;
    }

    public function deleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return true;
    }
}