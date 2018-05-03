<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    private $scheduledSettings = [
        [
            'id' => 1,
            'plan_start_date' => '2018-01-01',
            'amount' => 7.2
        ],
        [
            'id' => 2,
            'plan_start_date' => '2018-02-01',
            'amount' => 8.2
        ],
        [
            'id' => 3,
            'plan_start_date' => '2018-03-01',
            'amount' => 9.2
        ],
        [
            'tid' => 2,
            'plan_start_date' => '2018-03-05',
            'amount' => 10.2
        ]
    ];

    public function index()
    {
        $scheduledSettings = $this->scheduledSettings;
        return view('test', compact('scheduledSettings'));
    }

    public function update(Request $request)
    {
        $params = $request->input('data');
        $messages = [
            'plan_start_date.required'    => 'Please enter a valid date (yyyy-mm-dd)',
            'plan_start_date.date_format' => 'Please enter a valid date (yyyy-mm-dd)',
            'plan_start_date.max'         => 'Only accept maximum 255 characters.',
            //'plan_start_date.unique'      => 'This date already taken.',
            'amount.required'             => 'Please enter a valid number.',
            'amount.numeric'              => 'Please enter a valid number.',
        ];
        $rules = [
            'plan_start_date' => 'required|date_format:"Y-m-d"|max:255', //|unique:mile_basic_settings',
            'amount'          => 'required|numeric',
        ];
        $validator = Validator::make($params, $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator]);
        }
        
        $flag   = false;
        $first  = $this->scheduledSettings;
        foreach ($this->scheduledSettings as $k => $row) {
            if ($params['type'] == 'id' && $row['id'] == $params['id']) {
                $flag = true;
                $this->scheduledSettings[$k]['plan_start_date'] = $params['plan_start_date'];
                $this->scheduledSettings[$k]['amount']          = (float)$params['amount'];
                $this->scheduledSettings[$k]['operation_flag']  = 2;
                break;
            } elseif ($params['type'] == 'tid' && array_key_exists('tid', $row) && $row['tid'] == $params['id']) {
                $flag = true;
                $this->scheduledSettings[$k]['plan_start_date'] = $params['plan_start_date'];
                $this->scheduledSettings[$k]['amount']          = (float)$params['amount'];
                $this->scheduledSettings[$k]['operation_flag']  = 1;
                break;
            }
        }
        return response()->json(['success' => $flag, 'first' => $first, 'last' => $this->scheduledSettings]);
    }

    public function save(Request $request)
    {
        $data = $request->input('data');
        $added = [];
        $updated = [];
        $deleted = [];
        foreach ($this->scheduledSettings as $k => $row) {
            if (array_key_exists('operation_flag', $row)) {
                switch ((int)$row['operation_flag']) {
                    case 1: // added
                        if (array_key_exists('tid', $row)) {
                            $added[] = [
                                'plan_start_date' => $row['plan_start_date'],
                                'amount' => $row['amount']
                            ];
                        }
                        break;
                    case 2: // updated
                        if (array_key_exists('id', $row)) {
                            $updated[$row['id']] = [
                                'plan_start_date' => $row['plan_start_date'],
                                'amount' => $row['amount']
                            ];
                        }
                        break;
                    case 3: // deleted
                        if (array_key_exists('id', $row)) {
                            $deleted[] = $row['id'];
                        }
                        break;
                }
            }
        }
        return response()->json([
            'success' => true, 
            'data' => $this->scheduledSettings, 
            'added' => $added, 
            'updated' => $updated, 
            'deleted' => $deleted
        ]);
    }

    public function destroy(Request $request)
    {
        $flag = false;
        $params = $request->input('data');
        $first = $this->scheduledSettings;
        foreach ($this->scheduledSettings as $k => $row) {
            if ($params['type'] == 'id' && $row['id'] == $params['id']) {
                $flag = true;
                $this->scheduledSettings[$k]['operation_flag'] = 3;
                break;
            } elseif ($params['type'] == 'tid' && array_key_exists('tid', $row) && $row['tid'] == $params['id']) {
                $flag = true;
                //$this->scheduledSettings[$k]['operation_flag'] = 3;
                array_splice($this->scheduledSettings, $k, 1);
                break;
            }
        }
        return response()->json(['success' => $flag, 'first' => $first, 'last' => $this->scheduledSettings]);
    }
}
