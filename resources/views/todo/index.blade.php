@extends('layout')

@section('content')
    <!-- Judul Atas -->
    <div class="text-center mb-4">
        <h1 class="app-title d-inline-flex align-items-center justify-content-center">
            To Do List <span class="title-badge">📋</span>
        </h1>
    </div>

    <!-- Form Tambah Tugas Langsung di Atas (One-Page) -->
    <form action="{{ route('todo.store') }}" method="POST">
        @csrf
        <div class="add-pill-box">
            <input type="text" name="title" placeholder="Add new task" required>
            <button type="submit" class="btn-pill-add">Add</button>
        </div>

        <!-- Keterangan & Checkbox Selesai -->
        <div class="extra-inputs">
            <input type="text" name="description" class="form-control form-control-sm border-0 bg-transparent px-0 mb-2" placeholder="Keterangan tugas (opsional)...">
            <div class="form-check">
                <input type="checkbox" name="is_done" value="1" class="form-check-input" id="checkDoneNew">
                <label class="form-check-label small text-muted" for="checkDoneNew">Tandai langsung selesai</label>
            </div>
        </div>
    </form>

    <!-- Papan Daftar Tugas -->
    <div class="list-board">
        @php
            $lastDate = null;
        @endphp

        @forelse ($todos as $todo)
            <!-- Tampilkan Date hanya jika selesai DAN tanggalnya berbeda dari item di atasnya -->
            @if ($todo->is_done && $todo->completed_at)
                @php
                    $currentDate = \Carbon\Carbon::parse($todo->completed_at)->format('d/m/Y');
                @endphp

                @if ($currentDate !== $lastDate)
                    <span class="date-label">Date: {{ $currentDate }}</span>
                    @php $lastDate = $currentDate; @endphp
                @endif
            @endif

            <div class="task-pill {{ $todo->is_done ? 'completed' : '' }}">
                <!-- Checklist Lingkaran di Kiri -->
                <form action="{{ route('todo.toggle', $todo->id) }}" method="POST" class="m-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="check-circle {{ $todo->is_done ? 'checked' : '' }}" title="Tandai Selesai">
                        @if ($todo->is_done)
                            <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        @endif
                    </button>
                </form>

                <!-- Judul & Keterangan di Tengah -->
                <div class="px-2 flex-grow-1">
                    <div class="task-text">{{ $todo->title }}</div>
                    @if ($todo->description)
                        <div class="task-desc">{{ $todo->description }}</div>
                    @endif
                </div>

                <!-- Ikon Tempat Sampah SVG di Kanan -->
                <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-trash" title="Hapus Tugas">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                    </button>
                </form>
            </div>
        @empty
            <p class="text-center text-muted small my-3 mb-0">
                Belum ada tugas. Ketik tugas baru pada kolom di atas lalu tekan <strong>Add</strong>.
            </p>
        @endforelse
    </div>
@endsection
