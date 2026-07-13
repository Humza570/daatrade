<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Mail;

class Authors extends Component
{
    public $firstname, $email, $username, $authortype, $direct_publisher;
    public $selected_author_id;
    public $blocked = 0;
    protected $listeners = [
        'resetForms',
        'deleteAuthorAction'
    ];
    public function resetForms()
    {
        $this->firstname = $this->email = $this->firstname = $this->authortype = $this->direct_publisher = null;
        $this->resetErrorBag();
    }
    public function addAuthor()
    {
        $this->validate([
            'firstname' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:6|max:20',
            'authortype' => 'required',
            'direct_publisher' => 'required'
        ], [
            'authortype.required' => 'Choose Author Type',
            'direct_publisher.required' => 'Specify Author Publication Access',
        ]);
        if ($this->isOnline()) {
            $default_password = Random::generate(8);
            $author = new User();
            $author->firstname = $this->firstname;
            $author->email = $this->email;
            $author->username = $this->username;
            $author->password = Hash::make($default_password);
            $author->role = $this->authortype;
            $author->direct_publish = $this->direct_publisher;
            $saved = $author->save();

            // $date = array(
            //     'firstname' => $this->firstname,
            //     'email' => $this->email,
            //     'firstname' => $this->firstname,
            //     'password' => $default_password
            // );
            // $author_email = $this->email;
            // $author_firstname = $this->firstname;
            if ($saved) {
                $this->showToaster('General Settings have been successfully updated', 'success');
            } else {
                $this->showToaster('Something went wrong', 'error');
            }
        } else {
            $this->showToaster('You are offline, check your connection and submit form again', 'error');
        }
    }
    public function isOnline($site = 'https://google.com')
    {
        if (@fopen($site, 'r')) {
            return true;
        } else {
            return false;
        }
    }
    public function editAuthor($author)
    {
        $this->selected_author_id = $author['id'];
        $this->firstname = $author['firstname'];
        $this->email = $author['email'];
        $this->username = $author['username'];
        $this->authortype = $author['role'];
        $this->direct_publisher = $author['direct_publish'];
        $this->dispatchBrowserEvent('showEditAuthorModel');
    }
    public function updateAuthor()
    {
        $this->validate([
            'firstname' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->selected_author_id,
            'username' => 'required|unique:users,username|min:6|max:20' . $this->selected_author_id,
        ]);
        if ($this->selected_author_id) {
            $author = User::find($this->selected_author_id);
            $author->update([
                'firstname' => $this->firstname,
                'email' => $this->email,
                'username' => $this->username,
                'role' => $this->authortype,
                'blocked' => $this->blocked,
                'direct_publish' => $this->direct_publisher,
            ]);
            $this->showToaster('Author successfully updated', 'success');
            $this->dispatchBrowserEvent('hide_author_edit_modal');
        }
    }
    public function deleteAuthor($author)
    {
        $this->dispatchBrowserEvent('deleteAuthor', [
            'title' => 'Are You Sure?',
            'html' => 'You want to delete this author: <br> <br>' . $author['firstname'] . '<br>',
            'id' => $author['id'],
        ]);
    }

    public function deleteAuthorAction($id){
        $author = User::find($id);
        $author->delete();
        $this->showToaster('Author successfully Deleted', 'info');


    }

    public function showToaster($message, $type)
    {
        return $this->dispatchBrowserEvent('showToaster', [
            'type' => $type,
            'message' => $message
        ]);
    }
    public function render()
    {
        return view('livewire.authors', [
            'authors' => User::where('role', 'admin')->orwhere('role', 'author')->get(),
        ]);
    }
}
