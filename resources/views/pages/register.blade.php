@extends('layouts.app')

@section('title', 'Đăng ký APSN Forum 2026')

@section('content')
    <section class="hero">
        <h1>Registration — APSN Forum 2026 and APSN Council Meeting 2026</h1>
        <p class="lede">Viet Nam Maritime and Waterway Administration (VIMAWA), Ministry of Construction of Viet Nam is pleased to host The APEC Port Services Network (APSN) Forum 2026 and APSN Council Meeting 2026 from 14 to 18 December 2026 at Rex Hotel Saigon — Ho Chi Minh City, Viet Nam.</p>
        <div class="deadlines">
            @foreach (config('apsn.deadlines') as $who => $date)
                <article>
                    <small>{{ $who }}</small>
                    <strong>{{ $date }}</strong>
                </article>
            @endforeach
        </div>
    </section>

    @if ($errors->any())
        <p class="banner">Một số mục bắt buộc chưa hợp lệ. Vui lòng kiểm tra các dòng được đánh dấu.</p>
    @endif

    <form method="post" action="{{ route('register.store') }}" enctype="multipart/form-data">
        @csrf

        <section class="section">
            <h2>PERSONAL INFORMATION</h2>
            <div class="body">
                <div class="field">
                    <span class="choice-title">Title <em class="req">*</em></span>
                    <div class="choices">
                        @foreach (config('apsn.titles') as $title)
                            <label>
                                <input type="radio" name="title" value="{{ $title }}" @checked(old('title') === $title)>
                                {{ $title }}
                            </label>
                        @endforeach
                        <label class="other-line">
                            <input type="radio" name="title" value="other" @checked(old('title') === 'other')>
                            Other
                            <input type="text" name="title_other" value="{{ old('title_other') }}" placeholder="Title khác">
                        </label>
                    </div>
                    @error('title') <p class="error">{{ $message }}</p> @enderror
                    @error('title_other') <p class="error">{{ $message }}</p> @enderror
                </div>

                <label class="field">
                    <span>Full name (as shown in your passport) <em class="req">*</em></span>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" required>
                    @error('full_name') <p class="error">{{ $message }}</p> @enderror
                </label>

                <div class="field">
                    <span class="choice-title">Gender <em class="req">*</em></span>
                    <div class="choices">
                        @foreach (config('apsn.genders') as $gender)
                            <label>
                                <input type="radio" name="gender" value="{{ $gender }}" @checked(old('gender') === $gender)>
                                {{ $gender }}
                            </label>
                        @endforeach
                    </div>
                    @error('gender') <p class="error">{{ $message }}</p> @enderror
                </div>

                <label class="field">
                    <span>Date of birth <em class="req">*</em></span>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth') <p class="error">{{ $message }}</p> @enderror
                </label>

                <label class="field">
                    <span>Economy <em class="req">*</em></span>
                    <select name="economy" required>
                        <option value="">Chọn nền kinh tế</option>
                        @foreach (config('apsn.economies') as $economy)
                            <option value="{{ $economy }}" @selected(old('economy') === $economy)>{{ $economy }}</option>
                        @endforeach
                    </select>
                    @error('economy') <p class="error">{{ $message }}</p> @enderror
                </label>

                <label class="field">
                    <span>Organization <em class="req">*</em></span>
                    <input type="text" name="organization" value="{{ old('organization') }}" required>
                    @error('organization') <p class="error">{{ $message }}</p> @enderror
                </label>

                <label class="field">
                    <span>Position / Title <em class="req">*</em></span>
                    <input type="text" name="position" value="{{ old('position') }}" required>
                    @error('position') <p class="error">{{ $message }}</p> @enderror
                </label>

                <div class="field">
                    <span class="choice-title">Attending as <em class="req">*</em></span>
                    <div class="choices">
                        @foreach (config('apsn.roles') as $role)
                            <label>
                                <input type="radio" name="attending_as" value="{{ $role }}" @checked(old('attending_as') === $role)>
                                {{ $role }}
                            </label>
                        @endforeach
                    </div>
                    @error('attending_as') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <section class="section">
            <h2>PASSPORT DETAILS / VISA ARRANGEMENT</h2>
            <div class="body">
                <label class="field">
                    <span>Nationality <em class="req">*</em></span>
                    <input type="text" name="nationality" value="{{ old('nationality') }}" required>
                    @error('nationality') <p class="error">{{ $message }}</p> @enderror
                </label>

                <div class="field">
                    <span class="choice-title">Passport type <em class="req">*</em></span>
                    <div class="choices">
                        @foreach (config('apsn.passport_types') as $type)
                            <label>
                                <input type="radio" name="passport_type" value="{{ $type }}" @checked(old('passport_type') === $type)>
                                {{ $type }}
                            </label>
                        @endforeach
                    </div>
                    @error('passport_type') <p class="error">{{ $message }}</p> @enderror
                </div>

                <label class="field">
                    <span>Passport number <em class="req">*</em></span>
                    <input type="text" name="passport_number" value="{{ old('passport_number') }}" required>
                    @error('passport_number') <p class="error">{{ $message }}</p> @enderror
                </label>

                <label class="field">
                    <span>Date of expiry <em class="req">*</em></span>
                    <input type="date" name="passport_expiry" value="{{ old('passport_expiry') }}" required>
                    @error('passport_expiry') <p class="error">{{ $message }}</p> @enderror
                </label>

                <label class="field">
                    <span>Upload copy of passport data page <em class="req">*</em></span>
                    <input type="file" name="passport_copy" accept=".jpg,.jpeg,.png,.pdf" required>
                    <p class="hint">JPG, PNG hoặc PDF, tối đa 5 MB. Tệp chỉ lưu trên máy chủ, không hiển thị công khai.</p>
                    @error('passport_copy') <p class="error">{{ $message }}</p> @enderror
                </label>

                <div class="field">
                    <span class="choice-title">Visa status <em class="req">*</em></span>
                    <div class="choices">
                        @foreach (config('apsn.visa_statuses') as $status)
                            <label>
                                <input type="radio" name="visa_status" value="{{ $status }}" @checked(old('visa_status') === $status)>
                                {{ $status }}
                            </label>
                        @endforeach
                        <label class="other-line">
                            <input type="radio" name="visa_status" value="other" @checked(old('visa_status') === 'other')>
                            Other
                            <input type="text" name="visa_status_other" value="{{ old('visa_status_other') }}" placeholder="Ghi rõ tình trạng visa">
                        </label>
                    </div>
                    @error('visa_status') <p class="error">{{ $message }}</p> @enderror
                    @error('visa_status_other') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <section class="section">
            <h2>MEETING PARTICIPATION</h2>
            <div class="body">
                <p class="hint">Please indicate the meetings and activities you plan to attend. Some sessions may run in parallel. Please refer to the tentative program when making your selection.</p>
                <table class="grid">
                    <thead>
                        <tr>
                            <th>Which sessions/events will you attend?</th>
                            <th>Yes</th>
                            <th>No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (config('apsn.sessions') as $key => $label)
                            <tr>
                                <td>{{ $label }} @error('sessions.'.$key) <span class="error">{{ $message }}</span> @enderror</td>
                                <td><input type="radio" name="sessions[{{ $key }}]" value="Yes" @checked(old('sessions.'.$key) === 'Yes') aria-label="{{ $label }} Yes"></td>
                                <td><input type="radio" name="sessions[{{ $key }}]" value="No" @checked(old('sessions.'.$key) === 'No') aria-label="{{ $label }} No"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="section">
            <h2>TRAVEL DETAILS</h2>
            <div class="body">
                <p class="hint">If you do not yet have your flight and accommodation details, please skip this section and provide the information as soon as it becomes available.</p>
                <label class="field">
                    <span>Arrival date &amp; time</span>
                    <input type="datetime-local" name="arrival_at" value="{{ old('arrival_at') }}">
                    @error('arrival_at') <p class="error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Arrival flight number</span>
                    <input type="text" name="arrival_flight" value="{{ old('arrival_flight') }}">
                    @error('arrival_flight') <p class="error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Departure date &amp; time</span>
                    <input type="datetime-local" name="departure_at" value="{{ old('departure_at') }}">
                    @error('departure_at') <p class="error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Departure flight number</span>
                    <input type="text" name="departure_flight" value="{{ old('departure_flight') }}">
                    @error('departure_flight') <p class="error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Hotel name</span>
                    <input type="text" name="hotel_name" value="{{ old('hotel_name') }}">
                    @error('hotel_name') <p class="error">{{ $message }}</p> @enderror
                </label>
            </div>
        </section>

        <section class="section">
            <h2>CONTACT &amp; SPECIAL NEEDS</h2>
            <div class="body">
                <label class="field">
                    <span>Contact email <em class="req">*</em></span>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Mobile / WhatsApp number <em class="req">*</em></span>
                    <input type="text" name="phone" value="{{ old('phone') }}" required>
                    @error('phone') <p class="error">{{ $message }}</p> @enderror
                </label>
                <div class="field">
                    <span class="choice-title">Dietary requirements <em class="req">*</em></span>
                    <div class="choices">
                        @foreach (config('apsn.diets') as $diet)
                            <label>
                                <input type="radio" name="dietary" value="{{ $diet }}" @checked(old('dietary') === $diet)>
                                {{ $diet }}
                            </label>
                        @endforeach
                        <label class="other-line">
                            <input type="radio" name="dietary" value="other" @checked(old('dietary') === 'other')>
                            Other
                            <input type="text" name="dietary_other" value="{{ old('dietary_other') }}" placeholder="Yêu cầu ăn uống khác">
                        </label>
                    </div>
                    @error('dietary') <p class="error">{{ $message }}</p> @enderror
                    @error('dietary_other') <p class="error">{{ $message }}</p> @enderror
                </div>
                <label class="field">
                    <span>Accessibility needs <em class="req">*</em></span>
                    <input type="text" name="accessibility" value="{{ old('accessibility') }}" placeholder="Ghi None nếu không có nhu cầu đặc biệt" required>
                    @error('accessibility') <p class="error">{{ $message }}</p> @enderror
                </label>
                <div class="field check">
                    <label>
                        <input type="checkbox" name="consent" value="1" @checked(old('consent'))>
                        <span>I consent to the collection and processing of my personal data for event organization purposes. <em class="req">*</em></span>
                    </label>
                    @error('consent') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <div class="actions">
            <button type="submit">Gửi đăng ký</button>
            <span class="note">Dấu * là mục bắt buộc.</span>
        </div>
    </form>
@endsection
