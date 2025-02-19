<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public $posts, $title, $body, $post_id;
    public $isOpen = 0;
    public $search = ''; // Tambahkan properti pencarian

    public function mount()
    {
        // Ambil nilai search dari query string
        $this->search = request()->query('search', $this->search);
    }
    
    public function render()
    {
        $this->posts = Post::where('title', 'like', "%{$this->search}%")
                     ->orWhere('body', 'like', "%{$this->search}%")
                     ->get();

        return view('livewire.posts', ['posts' => $this->posts]);
    }

    public function search() // Fungsi untuk tombol search
    {
        // Tidak perlu menulis ulang karena Livewire otomatis merender ulang saat search berubah
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->body = '';
        $this->post_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'body' => $this->body
        ]);

        session()->flash('message', 
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;

        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
