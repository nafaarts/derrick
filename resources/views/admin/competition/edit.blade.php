@extends('admin._layouts.master')

@section('title', 'Edit Competition')

@section('body')
    <a href="{{ route('competition.index') }}" class="text-xs text-orange-800 rounded-md"><i
            class="fas fa-fw fa-arrow-left mb-3"></i> Back</a>
    <div class="bg-PRIMARY p-4 rounded-md w-full text-xs">
        <h2>Edit Competition</h2>
        <hr class="my-3">
        <form action="{{ route('competition.update', $competition) }}" method="POST" enctype="multipart/form-data"
            class="flex gap-2 md:flex-row flex-col" x-data="imageViewer()">
            <div class="md:w-3/4 w-full">
                @csrf
                @method('PUT')
                <div class="mb-4 flex gap-2" x-data="{ name: '{{ $competition->name }}', code: '{{ $competition->code }}' }">
                    <div class="w-3/4">
                        <label class="text-gray-600 capitalize">title <span class="text-red-500">*</span></label></br>
                        <input type="text" name="name" id="name" class="mt-1 w-full"
                            placeholder="Add competition title" x-model="name">
                        @error('name')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-1/4">
                        <label class="text-gray-600 capitalize">code <span class="text-red-500">*</span></label></br>
                        <input type="text" name="code" id="code" class="mt-1 w-full"
                            placeholder="Add competition code"
                            x-bind:value="code != '' ? code : name.match(/[A-Z]/g).join('')">
                        @error('code')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-2 mb-4">
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">Prize Pool <span class="text-red-500">*</span></label></br>
                        <input type="number" name="prize_pool" id="prize_pool" class="mt-1 w-full"
                            placeholder="Competition Prize Pool" value="{{ $competition->prize_pool }}">
                        @error('prize_pool')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">Max Member <span class="text-red-500">*</span></label></br>
                        <input type="number" name="max_member" id="max_member" class="mt-1 w-full"
                            placeholder="Max member allowed" value="{{ $competition->max_member }}">
                        @error('max_member')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-2 mb-4">
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">start date <span class="text-red-500">*</span></label></br>
                        <input type="date" name="start_date" id="start_date" class="mt-1 w-full"
                            value="{{ $competition->start_date }}">
                        @error('start_date')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="text-gray-600 capitalize">end date <span class="text-red-500">*</span></label></br>
                        <input type="date" name="end_date" id="end_date" class="mt-1 w-full"
                            value="{{ $competition->end_date }}">
                        @error('end_date')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Whatsapp Group Link </label></br>
                    <input type="text" name="wa_link" id="wa_link" class="mt-1 w-full"
                        placeholder="Add Whatsapp Group Link" value="{{ $competition->wa_link }}">
                    @error('wa_link')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">description <span class="text-red-500">*</span></label></br>
                    <textarea name="description" id="description" class="mt-1 w-full" rows="5" placeholder="Competition description">{{ $competition->description }}</textarea>
                    @error('description')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <fieldset class="border-2 border-TERTIARY rounded-md p-2 mb-4">
                    <legend class="text-gray-400">Registration Batch 1 :</legend>
                    <div class="flex gap-2 mb-4">
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">start date <span
                                    class="text-red-500">*</span></label></br>
                            <input type="date" name="date_reg_start_first_batch" id="date_reg_start_first_batch"
                                class="mt-1 w-full" value="{{ $competition->date_reg_start_first_batch }}">
                            @error('date_reg_start_first_batch')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">end date <span
                                    class="text-red-500">*</span></label></br>
                            <input type="date" name="date_reg_end_first_batch" id="date_reg_end_first_batch"
                                class="mt-1 w-full" value="{{ $competition->date_reg_end_first_batch }}">
                            @error('date_reg_end_first_batch')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="text-gray-600 capitalize">Registration Fee <span
                                class="text-red-500">*</span></label></br>
                        <input type="number" name="price_first_batch" id="price_first_batch" class="mt-1 w-full"
                            placeholder="Batch 1 Registration Fee" value="{{ $competition->price_first_batch }}">
                        @error('price_first_batch')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border-2 border-TERTIARY rounded-md p-2">
                    <legend class="text-gray-400">Registration Batch 2 :</legend>
                    <div class="flex gap-2 mb-4">
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">start date <span
                                    class="text-red-500">*</span></label></br>
                            <input type="date" name="date_reg_start_second_batch" id="date_reg_start_second_batch"
                                class="mt-1 w-full" value="{{ $competition->date_reg_start_second_batch }}">
                            @error('date_reg_start_second_batch')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label class="text-gray-600 capitalize">end date <span
                                    class="text-red-500">*</span></label></br>
                            <input type="date" name="date_reg_end_second_batch" id="date_reg_end_second_batch"
                                class="mt-1 w-full" value="{{ $competition->date_reg_end_second_batch }}">
                            @error('date_reg_end_second_batch')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="text-gray-600 capitalize">Registration Fee <span
                                class="text-red-500">*</span></label></br>
                        <input type="number" name="price_second_batch" id="price_second_batch" class="mt-1 w-full"
                            placeholder="Batch 2 Registration Fee" value="{{ $competition->price_second_batch }}">
                        @error('price_second_batch')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </fieldset>
            </div>
            <div class="md:w-1/4 w-full">
                <div class="mb-4 mt-5">
                    <div class="flex">
                        <div class="flex-1">
                            <select name="status" id="status" class="bg-TERTIARY rounded-l-md p-2 w-full">
                                <option value="1" @selected($competition->status == '1')>Save and Publish</option>
                                <option value="0" @selected($competition->status == '0')>Save Draft</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="py-2 px-4 rounded-r-md bg-orange-400 hover:bg-orange-500 text-white">Submit</button>
                    </div>
                    @error('status')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">Guide File <span class="text-red-500">*</span></label></br>
                    <input type="file" name="guide_file" id="guide_file" class="mt-1 w-full">
                    @error('guide_file')
                        <small class="text-red-500">{{ $message }}</small><br>
                    @enderror
                    <div class="text-red-400 hover:text-red-500 text-[9px] text-center overflow-hidden mt-2">
                        <i class="fas fw-fw fa-file mr-1"></i> <a target="_blank"
                            href="{{ asset('storage/competition/guide_book/' . $competition->guide_file) }}">{{ $competition->guide_file }}</a>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="text-gray-600 capitalize">upload logo <span class="text-red-500">*</span></label>
                    </br>
                    <div class="mt-1 image-form">
                        <label for="logo" class="overflow-hidden rounded-md">
                            <img :src="imageUrl" class="object-cover rounded w-full">
                            <input type="file" class="hidden" name="logo" id="logo" accept="image/*"
                                @change="fileChosen" x-on:click="type = 'logo'">
                        </label>
                    </div>
                    @error('logo')
                        <small class="text-red-500">{{ $message }}</small><br>
                    @enderror
                    <small>* click image to change</small>
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
                imageUrl: "{{ asset('storage/competition/logo/' . $competition->logo) }}",
                photo: "{{ asset('storage/competition/photo/' . $competition->photo) }}",
                type: '',
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.type === 'logo' ? this.imageUrl = src : this.photo = src)
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
