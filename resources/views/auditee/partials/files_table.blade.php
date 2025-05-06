{{-- Create this file at resources/views/auditee/partials/files_table.blade.php --}}
@foreach($siklus->siklus as $index => $file)
<tr>
    <td class="text-center">{{ $index + 1 }}</td>
    <td>
        <div class="d-flex align-items-center">
            <i class="bi {{ getFileIconClass($file->nama_berkas) }} fs-2 me-3"></i>
            <span>{{ $file->nama_berkas }}</span>
        </div>
    </td>
    <td class="text-center">
        <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="btn btn-sm btn-icon btn-light-info me-2" data-bs-toggle="tooltip" title="Lihat File">
            <i class="bi bi-eye-fill"></i>
        </a>
        @if(!$siklus->is_disetujui)
            <form action="{{ route('auditee.file.delete', $file->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-icon btn-light-danger delete-file-btn" data-bs-toggle="tooltip" title="Hapus File">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </form>
        @else
            <button type="button" class="btn btn-sm btn-icon btn-light-danger" disabled data-bs-toggle="tooltip" title="Tidak dapat dihapus">
                <i class="bi bi-trash-fill"></i>
            </button>
        @endif
    </td>
</tr>
@endforeach

@if(count($siklus->siklus) == 0)
<tr>
    <td colspan="3" class="text-center text-muted py-5">Belum ada file yang diunggah</td>
</tr>
@endif
