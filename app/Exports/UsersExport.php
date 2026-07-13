<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class UsersExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $users, $type;

    public function __construct($users,$type)
    {
        $this->users=$users;
        $this->type=$type;
    }
    public function view() : View
    {            
        if($this->type=="user")
        {
            return view('admin.usersexcel', [
                'users' => $this->users,
            ]);
        }
        else
        {
            return view('admin.subscriberexcel', [
                'users' => $this->users,
            ]);
        }
    }
}
