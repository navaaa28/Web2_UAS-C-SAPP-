@props(['editRoute', 'deleteRoute'])

<div class="flex items-center space-x-2">
    <a href="{{ $editRoute }}" class="p-2 text-blue-500 hover:text-blue-400 hover:bg-blue-500/10 rounded-lg transition-colors">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ $deleteRoute }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="p-2 text-red-500 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors"
                onclick="return confirm('Apakah Anda yakin ingin menghapus ini?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div> 