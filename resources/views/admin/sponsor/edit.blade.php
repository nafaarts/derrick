@extends('admin._layouts.master')

@section('title', 'Edit Sponsor')

@section('body')
    <a href="{{ route('sponsor.index') }}" class="text-xs text-orange-800 rounded-md"><i
            class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>Edit Sponsor</h2>
        <hr class="my-3 border-TERTIARY">
        <form action="{{ route('sponsor.update', $sponsor) }}" method="POST" enctype="multipart/form-data"
            class="flex gap-2 md:flex-row flex-col" x-data="imageViewer()">
            <div class="md:w-3/4 w-full">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">title <span class="text-red-500">*</span></label></br>
                    <input type="text" name="name" id="name" class="mt-1 w-full" placeholder="Add sponsor title"
                        value="{{ $sponsor->name }}">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">type <span class="text-red-500">*</span></label></br>
                    <div class="flex gap-2 mt-1">
                        <label for="sponsor" class="radio-form w-full">
                            <input type="radio" class="mr-2" name="type" id="sponsor" value="sponsor"
                                @checked($sponsor->type == 'sponsor') x-model="type">
                            Sponsor
                        </label>
                        <label for="organized" class="radio-form w-full">
                            <input type="radio" class="mr-2" name="type" id="organized" value="organized"
                                @checked($sponsor->type == 'organized') x-model="type">
                            Organizer
                        </label>
                        <label for="supported" class="radio-form w-full">
                            <input type="radio" class="mr-2" name="type" id="supported" value="supported"
                                @checked($sponsor->type == 'supported') x-model="type">
                            Supporter
                        </label>
                    </div>
                </div>
                <div :class="{ 'opacity-50': type != 'sponsor' }">
                    <label class="text-gray-600 capitalize">sponsor category <span
                            class="text-red-500">*</span></label></br>
                    <div class="flex gap-2 mt-1">
                        <label for="gold" class="radio-form w-full">
                            <input type="radio" class="mr-2" name="sponsor_category" id="gold" value="gold"
                                @checked($sponsor->sponsor_category == 'gold') x-bind:disabled="type != 'sponsor'">
                            Gold
                        </label>
                        <label for="silver" class="radio-form w-full">
                            <input type="radio" class="mr-2" name="sponsor_category" id="silver" value="silver"
                                @checked($sponsor->sponsor_category == 'silver') x-bind:disabled="type != 'sponsor'">
                            Silver
                        </label>
                        <label for="bronze" class="radio-form w-full">
                            <input type="radio" class="mr-2" name="sponsor_category" id="bronze" value="bronze"
                                @checked($sponsor->sponsor_category == 'bronze') x-bind:disabled="type != 'sponsor'">
                            Bronze
                        </label>
                    </div>
                    <small class="block mt-2">* Sponsor category required if type is set to
                        <strong>sponsor</strong></small>
                </div>
            </div>
            <div class="md:w-1/4 w-full">
                <div class="mb-4 mt-5">
                    <div class="flex">
                        <div class="flex-1">
                            <select name="status" id="status" class="bg-TERTIARY rounded-l-md p-2 w-full">
                                <option value="1" @selected($sponsor->status == '1')>Save and Publish</option>
                                <option value="0" @selected($sponsor->status == '0')>Save Draft</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="py-2 px-4 rounded-r-md bg-orange-400 hover:bg-orange-500 text-white">Submit</button>
                    </div>
                    @error('status')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-600 capitalize">upload logo <span class="text-red-500">*</span></label>
                    </br>
                    <div class="mt-1 image-form">
                        <label for="logo" class="overflow-hidden rounded-md">
                            <img :src="imageUrl" class="object-cover rounded w-full">
                            <input type="file" class="hidden" name="logo" id="logo" accept="image/*"
                                @change="fileChosen">
                        </label>
                    </div>
                    @error('logo')
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
                imageUrl: "{{ asset('storage/sponsors/' . $sponsor->logo) }}",
                type: '{{ $sponsor->type }}',
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
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
