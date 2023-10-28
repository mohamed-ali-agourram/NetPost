<div class="post_from_model" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div class="post_from_model_backdrop" @click="$dispatch('close-form')"></div>
    <form wire:submit.prevent='{{ isset($post) ? ' update()' : 'create' }}' enctype="multipart/form-data">
        <h1>Create a new post</h1>
        <button type="button" class="cancel" @click="$dispatch('close-form')">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>
        <div class="author">
            <img src="{{ auth()->user()->image() }}" alt="user">
            <div>
                <p>{{ auth()->user()->name }}</p>
                <div class="custom-select">
                    <select>
                        <option value="false">Private</option>
                        <option value="true">Public</option>
                    </select>
                    <div class="custom-arrow">
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="textarea">
            <textarea wire:model='body' type="text" id="content" name="body"
                placeholder="Share your thoughts with the world, {{ auth()->user()->name }}"></textarea>
            @error('body')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="file-input-container">
            <label for="file-input" class="custom-file-input">
                <i class="fa-regular fa-square-plus"></i>
                <p>Add a picture</p>
                <span>Pictures should be less then 5MB</span>
            </label>
            <input type="file" id="file-input" wire:model='image' accept="image/png, image/jpg" name="image"
                class="actual-file-input" />
            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
            @if ($image)
                <img class="preview" src="{{ $image->temporaryUrl() }}" alt="preview" />
                <div wire:click='resetImage' onclick="document.getElementById('file-input').value = ''" class="remove-preview">
                    <i class="fa-solid fa-square-minus"></i>
                    <p>Rmove this picture</p>
                </div>
            @endif
        </div>

        <button class="confirm">Post</button>
    </form>
</div>
