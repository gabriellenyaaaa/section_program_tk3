@extends('layout')

@section('content')
    <h2 class="h4 font-weight-bold mb-4">Tambah To-Do Baru</h2>

    <form action="{{ route('todo.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label style="color: #b5cad8;">Judul ToDo</label>
            <input type="text" name="title" class="form-control form-control-dark" placeholder="Please Enter a New task" required>
        </div>

        <div class="form-group">
            <label style="color: #b5cad8;">Keterangan</label>
            <textarea name="description" class="form-control form-control-dark" rows="3" placeholder="Tulis keterangan tugas..."></textarea>
        </div>

        <div class="form-group form-check my-3">
            <input type="checkbox" name="is_done" value="1" class="form-check-input custom-check" id="isDoneCheck">
            <label class="form-check-label ml-2" for="isDoneCheck" style="color: #d0e0eb;">
                Selesai (otomatis mencatat tanggal penyelesaian hari ini)
            </label>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('todo.index') }}" class="btn btn-outline-light mr-2">Batal</a>
            <button type="submit" class="btn btn-add">SIMPAN</button>
        </div>
    </form>
@endsection
