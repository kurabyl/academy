<?php

namespace App\UseCases\Section;
use App\Entity\User\User;
use App\Entity\Section;

class SectionService
{

	public function create($request)
	{
		$section = Section::create([

			'title'=>$request['title'],
            'icon'=>$request['icon'],
		]);

		return $section;
	}

	public function edit($request)
	{
		$section = $this->getSection($request['id']);

		$section->title = $request['title'];
		$section->icon = $request['icon'];

		$section->save();

		return $section;
	}

	public function delete($request)
	{
		$section = $this->getSection($request['id']);

		$section->delete();
	}

	private function getSection($id)
	{
		return Section::findOrFail($id);
	}
}
