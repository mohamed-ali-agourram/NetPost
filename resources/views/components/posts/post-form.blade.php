<div x-data="{
    body: '',
    image: null,
    clearFileInput() {
        document.getElementById('file-input').value = '';
        this.image = null;
        this.body = '';
    }
}" class="post_from_model" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div class="post_from_model_backdrop" @click="$dispatch('close-form')"></div>
    <form wire:submit.prevent='{{ isset($post) ? ' update()' : 'create' }}' enctype="multipart/form-data">
        <h1>Create a new post</h1>
        <button type="button" class="cancel" @click="$dispatch('close-form')">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>
        <div class="author">
            <img src="{{ auth()->user()->profile_image() }}" alt="user">
            <div>
                <b>{{ auth()->user()->name }}</b>
                <div class="custom-select">
                    <select wire:model='is_published'>
                        <option value="1" @selected($is_published === '1')>Public</option>
                        <option value="0" @selected($is_published === '0')>Private</option>
                    </select>
                    <div class="custom-arrow">
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="textarea">
            <textarea x-model="body" wire:model='body' type="text" id="content" name="body"
                placeholder="Share your thoughts with the world, {{ auth()->user()->name }}"></textarea>
            @error('body')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        @if (isset($post->shared_post) === false)
            <div class="file-input-container">
                <label for="file-input" class="custom-file-input">
                    <i class="fa-regular fa-square-plus"></i>
                    <p>Add a picture</p>
                    <span>Pictures should be less then 5MB</span>
                </label>
                <input type="file" id="file-input" x-on:change="image = $event.target.files[0]" wire:model='image'
                    accept=".jpg, .png" name="image" class="actual-file-input" />
                <span wire:loading wire:target="image" class="spinner-backdrop">
                    <span class="lds-ripple">
                        <span></span>
                        <span></span>
                    </span>
                </span>
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
                @if ($image)
                    @if (method_exists($image, 'temporaryUrl'))
                        <img class="preview" src="{{ $image->temporaryUrl() }}" alt="preview" />
                    @else
                        <img class="preview" src="{{ asset('storage/' . $this->image) }}" alt="preview" />
                    @endif

                    <div wire:click='resetImage' @click="clearFileInput" class="remove-preview">
                        <i class="fa-solid fa-square-minus"></i>
                        <p>Rmove this picture</p>
                    </div>
                @endif
            </div>
        @endif
        <button @click="clearFileInput"
            x-bind:class="{{ !$isEditMode }} && (body.length > 0 || image !== null) ? '' : 'loading'" class="confirm"
            wire:loading.class="loading" wire:loading.attr="disabled">{{ $isEditMode ? 'Update' : 'Post' }}</button>
    </form>
</div>
