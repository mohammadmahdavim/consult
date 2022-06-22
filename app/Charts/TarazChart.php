<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Student;
use App\Models\Taraz;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class TarazChart extends BaseChart
{

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $id = $request->id;
        $id=Student::where('user_id',$id)->pluck('id')->first();
        $data=Taraz::where('student_id',$id)->with('testName')->orderBy('test_id','desc')->get();
        $keys = [];
        $value = [];
        $value2 = [];
        $value3 = [];

        foreach ($data as $row) {
            $keys[] = $row->testName->name;
            $value[] = $row->all;
            $value2[] = $row->public;
            $value3[] = $row->special;
        }
        return Chartisan::build()
            ->labels($keys)
            ->dataset('کل', $value)
            ->dataset('عمومی', $value2)
            ->dataset('اختصاصی', $value3);
    }
}
