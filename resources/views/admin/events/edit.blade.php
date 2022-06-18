@extends('admin._layouts.master')

@section('title', 'Edit Event')

@section('body')
    <a href="{{ route('event.index') }}" class="text-xs text-orange-800 rounded-md"><i
            class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>Edit Event</h2>
        <hr class="my-3 border-TERTIARY">
        <form action="{{ route('event.update', $event) }}" method="POST" enctype="multipart/form-data"
            class="flex gap-2 md:flex-row flex-col" x-data="imageViewer()">
            <div class="md:w-3/4 w-full">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">title <span class="text-red-500">*</span></label></br>
                    <input type="text" name="name" id="name" class="mt-1 w-full"
                        placeholder="Add competition title" value="{{ $event->name }}">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex gap-2 mb-4">
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">start date <span class="text-red-500">*</span></label></br>
                        <input type="date" name="start_date" id="start_date" class="mt-1 w-full"
                            value="{{ $event->start_date }}">
                        @error('start_date')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">end date <span class="text-red-500">*</span></label></br>
                        <input type="date" name="end_date" id="end_date" class="mt-1 w-full"
                            value="{{ $event->end_date }}">
                        @error('end_date')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-4" x-data="{ selected: '{{ str()->lower($event->category) ?? 'pre' }}' }">
                    <label class="text-gray-600 capitalize">Category <span class="text-red-500">*</span></label></br>
                    <div class="flex gap-2 mt-1">
                        <label for="pre" class="w-full p-2 rounded-md"
                            :class="selected === 'pre' ? 'bg-SECONDARY text-white' : 'bg-white/50 text-black'">
                            <input type="radio" id="pre" name="category" x-on:click="selected = 'pre'"
                                @checked(str()->lower($event->category) == 'pre') value="pre">
                            <span class="ml-2">PRE EVENT</span>
                        </label>
                        <label for="post" class="w-full p-2 rounded-md"
                            :class="selected === 'post' ? 'bg-SECONDARY text-white' : 'bg-white/50 text-black'">
                            <input type="radio" id="post" name="category" x-on:click="selected = 'post'"
                                @checked(str()->lower($event->category) == 'post') value="post">
                            <span class="ml-2">POST EVENT</span>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Whatsapp Group Invitation Link <span
                            class="text-red-500">*</span></label></br>
                    <input type="text" name="wa_link" id="wa_link" class="mt-1 w-full"
                        placeholder="Add Whatsapp Group link" value="{{ $event->wa_link }}">
                    @error('wa_link')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-600 capitalize">description <span class="text-red-500">*</span></label></br>
                    <textarea rows="14" name="description" id="description" class="mt-1 w-full" placeholder="Competition description">{{ $event->description }}</textarea>
                    @error('description')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="md:w-1/4 w-full">
                <div class="mb-4 mt-5">
                    <div class="flex">
                        <div class="flex-1">
                            <select name="status" id="status" class="bg-TERTIARY h-full rounded-l-md p-2 w-full">
                                <option value="1" @selected($event->status == '1')>Save and Publish</option>
                                <option value="0" @selected($event->status == '0')>Save Draft</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="py-2 px-4 rounded-r-md bg-SECONDARY hover:bg-SECONDARY/80 text-white">Submit</button>
                    </div>
                    @error('status')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Require Registration <span class="text-red-500">*</span></label>
                    </br>
                    <label for="registration_required" class="w-full p-2 rounded-md mt-1 flex items-center">
                        <input type="checkbox" id="registration_required" name="registration_required"
                            @checked(old('registration_required') ?? $event->registration_required) value="1">
                        <span class="ml-2">Yes</span>
                    </label>
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">event logo <span class="text-red-500">*</span></label>
                    </br>
                    <div class="mt-1 image-form">
                        <label for="logo" class="overflow-hidden rounded-md">
                            <img :src="imageUrl" class="object-cover rounded w-full">
                            <input type="file" class="hidden" name="logo" id="logo" accept="image/*"
                                x-on:change="fileChosen" x-on:click="type = 'logo'">
                        </label>
                    </div>
                    @error('logo')
                        <small class="text-red-500">{{ $message }}</small><br>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-600 capitalize">background Photo <span class="text-red-500">*</span></label>
                    </br>
                    <div class="mt-1 image-form">
                        <label for="photo" class="overflow-hidden rounded-md">
                            <img :src="photo" class="object-cover rounded w-full">
                            <input type="file" class="hidden" name="photo" id="photo" accept="image/*"
                                x-on:change="fileChosen" x-on:click="type = 'photo'">
                        </label>
                    </div>
                    @error('photo')
                        <small class="text-red-500">{{ $message }}</small><br>
                    @enderror
                    <small>* click image to change</small>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function imageViewer() {
            return {
                imageUrl: "{{ asset('storage/events/logo/' . $event->logo) }}",
                photo: "{{ asset('storage/events/photo/' . $event->photo) }}",
                type: '',
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.type === 'logo' ? this.imageUrl = src : this.photo = src)
                    this.link = ""
                },
                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return
                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }
    </script>
@endsection
