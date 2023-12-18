<form class="search_box" wire:submit.prevent="handleSubmit" action="{{ route('search') }}">
    <label for="search"></label>
    <input wire:model="search" type="text" name="search" placeholder="search" id="search" value="{{ $search }}">
    @error('search')
        <span class="error">{{ $message }}</span>
    @enderror
    <button><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
