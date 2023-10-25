<div class="post_from_model" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div style="display: {{ $is_open ? 'flex' : 'none' }}" @click="$dispatch('close-form')"
        class="post_from_model_backdrop"></div>
    <form wire:submit.prevent='{{ isset($post) ? 'update()' : 'create' }}' enctype="multipart/form-data">
        <h1>Add your post</h1>
        <div>
            <label for="title">Title: </label>
            <span>Provide a short title to your form</span>
            <input wire:model='title' name="title" type="text" id="title">
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="content">Content: </label>
            <span>This is the main description for your post</span>
            <textarea wire:model='body' name="body" type="text" id="content"></textarea>
            @error('body')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="image">image: </label>
            <span>max length is 100 MB</span>
            <input wire:model='image' accept="image/png, image/jpg" type="file" id="image">
            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" alt="preview" style="max-width: 150px; max-height: 150px;" />
            @endif
        </div>
        <div class="btns">
            <button class="cancel" type="button" @click="$dispatch('close-form')">Cancel</button>
            <button class="confirm">{{ isset($post) ? 'Update' : 'Post' }}</button>
        </div>
    </form>
</div>
