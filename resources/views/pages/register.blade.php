@extends('layouts.app')

@section('title', ($invited ? 'Invited Guest Registration' : 'Registration').' — APSN Forum 2026 and Council Meeting 2026')

@section('content')
  <div class="page-intro">
    <span class="page-badge">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="16" y1="13" x2="8" y2="13"></line>
        <line x1="16" y1="17" x2="8" y2="17"></line>
        <polyline points="10 9 9 9 8 9"></polyline>
      </svg>
      Official Accreditation &amp; Registration Portal
    </span>
    @if ($invited)
      <h1 class="page-title">Invited Guest Registration — APSN Forum 2026</h1>
      <p class="page-lede">This form is for invited guests of the APSN Forum 2026, held from 14 to 18 December 2026 at Rex Hotel Saigon — Ho Chi Minh City, Viet Nam.</p>
    @else
      <h1 class="page-title">Registration — APSN Forum 2026 &amp; APSN Council Meeting 2026</h1>
      <p class="page-lede">Viet Nam Maritime and Waterway Administration (VIMAWA), Ministry of Construction of Viet Nam is pleased to host The APEC Port Services Network (APSN) Forum
        2026 and APSN Council Meeting 2026 from 14 to 18 December 2026 at Rex Hotel Saigon — Ho Chi Minh City, Viet Nam.</p>
    @endif
  </div>

  <!-- Deadlines Status Cards -->
  <div class="deadlines-section">
    <div class="deadlines-heading">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2">
        <circle cx="12" cy="12" r="10"></circle>
        <polyline points="12 6 12 12 16 14"></polyline>
      </svg>
      <span>Registration Deadlines</span>
    </div>
    <div class="deadlines-grid">
      @foreach (config('apsn.deadlines') as $who => $date)
        <div class="deadline-card">
          <div class="deadline-target">
            <span class="deadline-target-name">{{ $who }}</span>
            @if (str_contains($who, 'NMP'))
              <span class="deadline-pill" style="background:#E0F2FE; color:#0369A1;">Enterprise</span>
            @else
              <span class="deadline-pill" style="background:#F1F5F9; color:#475569;">Participant</span>
            @endif
          </div>
          <div class="deadline-date">{{ $date }}</div>
        </div>
      @endforeach
    </div>
  </div>

  @if ($errors->any())
    <div class="alert-banner">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
      <span>Some required fields are missing or invalid. Please review the fields marked below.</span>
    </div>
  @endif

  <form method="post" action="{{ $invited ? route('register.invited.store').'?invited' : route('register.store') }}" enctype="multipart/form-data" class="registration-form">
    @csrf
    <input type="hidden" name="submission_token" value="{{ old('submission_token', $submissionToken) }}">

    <!-- 01: PERSONAL INFORMATION -->
    <section class="form-section">
      <div class="section-header">
        <span class="section-number">01</span>
        <h2 class="section-title">Personal Information</h2>
      </div>
      <div class="section-body">
        <div class="form-grid">
          <!-- Title -->
          <div class="field col-full">
            <span class="choice-title">Title <em class="req">*</em></span>
            <div class="choices">
              @foreach (config('apsn.titles') as $title)
                <label>
                  <input type="radio" name="title" value="{{ $title }}" @checked(old('title') === $title)>
                  <span>{{ $title }}</span>
                </label>
              @endforeach
              <label class="other-line">
                <input type="radio" name="title" value="other" @checked(old('title') === 'other')>
                <span>Other:</span>
                <input type="text" name="title_other" value="{{ old('title_other') }}" placeholder="Other title...">
              </label>
            </div>
            @error('title')
              <p class="error-text">{{ $message }}</p>
            @enderror
            @error('title_other')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </div>

          <!-- Full Name -->
          <label class="field col-full">
            <span class="field-label">Full name (as shown in your passport) <em class="req">*</em></span>
            <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="e.g. TRAN VAN AN" required>
            <span class="field-helper">Please enter your name exactly as it appears in your passport.</span>
            @error('full_name')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <!-- Gender -->
          <div class="field">
            <span class="choice-title">Gender <em class="req">*</em></span>
            <div class="choices">
              @foreach (config('apsn.genders') as $gender)
                <label>
                  <input type="radio" name="gender" value="{{ $gender }}" @checked(old('gender') === $gender)>
                  <span>{{ $gender }}</span>
                </label>
              @endforeach
            </div>
            @error('gender')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </div>

          <!-- Date of Birth -->
          <label class="field">
            <span class="field-label">Date of birth <em class="req">*</em></span>
            <input type="text" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="YYYY-MM-DD" lang="en-US" required>
            @error('date_of_birth')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          @unless ($invited)
            <!-- Economy -->
            <label class="field">
              <span class="field-label">APEC Economy <em class="req">*</em></span>
              <select name="economy" required>
                <option value="">-- Select Economy --</option>
                @foreach (config('apsn.economies') as $economy)
                  <option value="{{ $economy }}" @selected(old('economy') === $economy)>{{ $economy }}</option>
                @endforeach
              </select>
              @error('economy')
                <p class="error-text">{{ $message }}</p>
              @enderror
            </label>
          @endunless

          <!-- Organization -->
          <label class="field">
            <span class="field-label">Organization <em class="req">*</em></span>
            <input type="text" name="organization" value="{{ old('organization') }}" placeholder="e.g. Port Authority / Ministry of Transport" required>
            @error('organization')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <!-- Position -->
          <label class="field col-full">
            <span class="field-label">Position <em class="req">*</em></span>
            <input type="text" name="position" value="{{ old('position') }}" placeholder="e.g. Director General, Chief Representative" required>
            @error('position')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          @unless ($invited)
            <!-- Attending As -->
            <div class="field col-full">
              <span class="choice-title">Attending as <em class="req">*</em></span>
              <div class="choices">
                @foreach (config('apsn.roles') as $role)
                  <label>
                    <input type="radio" name="attending_as" value="{{ $role }}" @checked(old('attending_as') === $role)>
                    <span>{{ $role }}</span>
                  </label>
                @endforeach
              </div>
              @error('attending_as')
                <p class="error-text">{{ $message }}</p>
              @enderror
            </div>
          @endunless
        </div>
      </div>
    </section>

    @unless ($invited)
    <!-- 02: PASSPORT DETAILS / VISA ARRANGEMENT -->
    <section class="form-section">
      <div class="section-header">
        <span class="section-number">02</span>
        <h2 class="section-title">Passport Details / Visa Arrangement</h2>
      </div>
      <div class="section-body">
        <div class="form-grid">
          <!-- Economy -->
          <label class="field">
            <span class="field-label">Economy <em class="req">*</em></span>
            <select name="nationality" required>
              <option value="">-- Select Economy --</option>
              @foreach (config('apsn.economies') as $economy)
                <option value="{{ $economy }}" @selected(old('economy') === $economy)>{{ $economy }}</option>
              @endforeach
            </select>
            @error('nationality')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <!-- Passport Type -->
          <div class="field">
            <span class="choice-title">Passport type <em class="req">*</em></span>
            <div class="choices">
              @foreach (config('apsn.passport_types') as $type)
                <label>
                  <input type="radio" name="passport_type" value="{{ $type }}" @checked(old('passport_type') === $type)>
                  <span>{{ $type }}</span>
                </label>
              @endforeach
            </div>
            @error('passport_type')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </div>

          <!-- Passport Number -->
          <label class="field">
            <span class="field-label">Passport number <em class="req">*</em></span>
            <input type="text" name="passport_number" value="{{ old('passport_number') }}" placeholder="e.g. E1234567" required>
            @error('passport_number')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <!-- Passport Expiry -->
          <label class="field">
            <span class="field-label">Date of expiry <em class="req">*</em></span>
            <input type="text" id="passport_expiry" name="passport_expiry" value="{{ old('passport_expiry') }}" placeholder="YYYY-MM-DD" lang="en-US" required>
            <span class="field-helper">Your passport must remain valid for at least six months from your date of entry into Viet Nam.</span>
            @error('passport_expiry')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <!-- Passport Copy Upload -->
          <div class="field col-full">
            <span class="field-label">Upload a copy of the passport data page (Submission of the passport biodata page is mandatory for participants joining the port visit to meet port security requirements.)</span>
            <div class="file-upload-box">
              <div class="upload-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="17 8 12 3 7 8"></polyline>
                  <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
              </div>
              <input type="file" name="passport_copy" accept=".jpg,.jpeg,.png,.pdf" class="file-upload-input">
              <p class="field-helper" style="margin-top: 8px;">Accepted formats: <strong>JPG, PNG, or PDF</strong>. Maximum size: <strong>5 MB</strong>.</p>
              <div class="upload-confidentiality">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <span>Your file is encrypted and stored securely for event registration purposes only.</span>
              </div>
            </div>
            @error('passport_copy')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </div>

          <!-- Visa Status -->
          <div class="field col-full">
            <span class="choice-title">Visa status <em class="req">*</em></span>
            <div class="choices" style="display:flex; flex-direction:column; gap:8px;">
              @foreach (config('apsn.visa_statuses') as $status)
                <label style="display:flex; align-items:flex-start;">
                  <input type="radio" name="visa_status" value="{{ $status }}" @checked(old('visa_status') === $status)>
                  <span>{{ $status }}</span>
                </label>
              @endforeach
            </div>
            @error('visa_status')
              <p class="error-text">{{ $message }}</p>
            @enderror
            <label id="visa-email-field" class="field" @if (old('visa_status') !== config('apsn.e_visa_status')) style="display: none;" @endif>
              <span class="field-label">Email for e-visa application <em class="req">*</em></span>
              <input type="email" name="visa_email" value="{{ old('visa_email') }}" placeholder="delegate@domain.org" @required(old('visa_status') === config('apsn.e_visa_status'))>
              @error('visa_email')
                <p class="error-text">{{ $message }}</p>
              @enderror
            </label>
          </div>
        </div>
      </div>
    </section>
    @endunless

    <!-- 03: MEETING PARTICIPATION -->
    <section class="form-section">
      <div class="section-header">
        <span class="section-number">{{ $invited ? '02' : '03' }}</span>
        <h2 class="section-title">Meeting Participation</h2>
      </div>
      <div class="section-body">
        <div class="section-intro-hint">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
          </svg>
          <span>Please indicate the meetings and activities you plan to attend. Some sessions may run in parallel. Please refer to the tentative program when making your
            selection.</span>
        </div>

        <div class="session-matrix">
          @foreach (config('apsn.sessions') as $key => $label)
            @continue($invited && in_array($key, ['technical_visit', 'council'], true))
            <div class="session-item">
              <div class="session-info">
                <div class="session-name">{{ $label }}</div>
                <div>
                  @if (str_contains(strtolower($label), 'council'))
                    <span class="session-pill-tag session-pill-gold">Council Members Only</span>
                  @elseif(str_contains(strtolower($label), 'dinner'))
                    <span class="session-pill-tag">Official Banquet</span>
                  @elseif(str_contains(strtolower($label), 'technical'))
                    <span class="session-pill-tag">Field &amp; Port Visit</span>
                  @else
                    <span class="session-pill-tag">Plenary Forum</span>
                  @endif
                </div>
                @error('sessions.' . $key)
                  <p class="error-text">{{ $message }}</p>
                @enderror
              </div>
              <div class="session-actions">
                <label class="toggle-option">
                  <input type="radio" name="sessions[{{ $key }}]" value="Yes" @checked(old('sessions.' . $key) === 'Yes') aria-label="{{ $label }} Yes">
                  <span>Yes</span>
                </label>
                <label class="toggle-option">
                  <input type="radio" name="sessions[{{ $key }}]" value="No" @checked(old('sessions.' . $key) === 'No') aria-label="{{ $label }} No">
                  <span>No</span>
                </label>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    @unless ($invited)
    <!-- 04: TRAVEL DETAILS -->
    <section class="form-section">
      <div class="section-header">
        <span class="section-number">04</span>
        <h2 class="section-title">Travel Details</h2>
      </div>
      <div class="section-body">
        <div class="section-intro-hint">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path
              d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z">
            </path>
          </svg>
          <span>If you do not yet have your flight and accommodation details, please skip this section and provide the information as soon as it becomes available.</span>
        </div>
        <div class="form-grid">
          <label class="field">
            <span class="field-label">Arrival date &amp; time</span>
            <input type="text" id="arrival_at" name="arrival_at" value="{{ old('arrival_at') }}" placeholder="YYYY-MM-DD HH:MM" lang="en-US">
            @error('arrival_at')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <label class="field">
            <span class="field-label">Arrival flight number</span>
            <input type="text" name="arrival_flight" value="{{ old('arrival_flight') }}" placeholder="e.g. VN650, SQ178">
            @error('arrival_flight')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <label class="field">
            <span class="field-label">Departure date &amp; time</span>
            <input type="text" id="departure_at" name="departure_at" value="{{ old('departure_at') }}" placeholder="YYYY-MM-DD HH:MM" lang="en-US">
            @error('departure_at')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <label class="field">
            <span class="field-label">Departure flight number</span>
            <input type="text" name="departure_flight" value="{{ old('departure_flight') }}" placeholder="e.g. VN651, SQ185">
            @error('departure_flight')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <label class="field col-full">
            <span class="field-label">Hotel name</span>
            <input type="text" name="hotel_name" value="{{ old('hotel_name') }}" placeholder="e.g. Rex Hotel Saigon / Saigon Prince Hotel / Oscar Saigon Hotel">
            <span class="field-helper">Delegates may stay at the official Rex Hotel or another nearby hotel.</span>
            @error('hotel_name')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>
        </div>
      </div>
    </section>
    @endunless

    <!-- 05: CONTACT & SPECIAL NEEDS -->
    <section class="form-section">
      <div class="section-header">
        <span class="section-number">{{ $invited ? '03' : '05' }}</span>
        <h2 class="section-title">Contact &amp; Special Needs</h2>
      </div>
      <div class="section-body">
        <div class="form-grid">
          <label class="field">
            <span class="field-label">Contact email <em class="req">*</em></span>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="delegate@domain.org" required>
            <span class="field-helper">Your confirmation and event information will be sent to this email address.</span>
            @error('email')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <label class="field">
            <span class="field-label">Mobile / WhatsApp number <em class="req">*</em></span>
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+84 90 123 4567" required>
            @error('phone')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <!-- Dietary -->
          <div class="field col-full">
            <span class="choice-title">Dietary requirements <em class="req">*</em></span>
            <div class="choices">
              @foreach (config('apsn.diets') as $diet)
                <label>
                  <input type="radio" name="dietary" value="{{ $diet }}" @checked(old('dietary') === $diet)>
                  <span>{{ $diet }}</span>
                </label>
              @endforeach
              <label class="other-line">
                <input type="radio" name="dietary" value="other" @checked(old('dietary') === 'other')>
                <span>Other:</span>
                <input type="text" name="dietary_other" value="{{ old('dietary_other') }}" placeholder="Other dietary requirement...">
              </label>
            </div>
            @error('dietary')
              <p class="error-text">{{ $message }}</p>
            @enderror
            @error('dietary_other')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </div>

          <!-- Accessibility -->
          <label class="field col-full">
            <span class="field-label">Accessibility needs <em class="req">*</em></span>
            <input type="text" name="accessibility" value="{{ old('accessibility') }}" placeholder="Enter 'None' if you have no accessibility needs" required>
            @error('accessibility')
              <p class="error-text">{{ $message }}</p>
            @enderror
          </label>

          <!-- Consent -->
          <div class="col-full consent-card">
            <label>
              <input type="checkbox" name="consent" value="1" @checked(old('consent'))>
              <span>I consent to the collection and processing of my personal data for event organization, accreditation, and immigration coordination purposes. <em
                  class="req">*</em></span>
            </label>
            @error('consent')
              <p class="error-text" style="margin-top: 8px;">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>
    </section>

    <!-- Actions -->
    <div class="form-actions">
      <button type="submit" class="btn-submit">
        <span>Submit Registration</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </button>
      <div class="form-footnote">
        <span class="req" style="font-size:16px;">*</span>
        <span>Indicates a required field.</span>
      </div>
    </div>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const eVisaStatus = @json(config('apsn.e_visa_status'));
      const visaStatusInputs = document.querySelectorAll('input[name="visa_status"]');
      const visaEmailField = document.getElementById('visa-email-field');
      const visaEmailInput = visaEmailField?.querySelector('input[name="visa_email"]');
      const registrationForm = document.querySelector('.registration-form');
      const submitButton = registrationForm.querySelector('button[type="submit"]');

      registrationForm.addEventListener('submit', () => {
        submitButton.disabled = true;
        submitButton.setAttribute('aria-busy', 'true');
        submitButton.querySelector('span').textContent = 'Submitting...';
      });

      const updateVisaEmailField = () => {
        if (!visaEmailField || !visaEmailInput) {
          return;
        }

        const selectedStatus = document.querySelector('input[name="visa_status"]:checked')?.value;
        const requiresEmail = selectedStatus === eVisaStatus;

        visaEmailField.style.display = requiresEmail ? '' : 'none';
        visaEmailInput.required = requiresEmail;

        if (!requiresEmail) {
          visaEmailInput.value = '';
        }
      };

      visaStatusInputs.forEach((input) => input.addEventListener('change', updateVisaEmailField));
      updateVisaEmailField();

      if (typeof flatpickr !== 'undefined') {
        flatpickr('#date_of_birth', {
          dateFormat: 'Y-m-d',
          maxDate: 'today',
          disableMobile: true,
          altInput: true,
          altFormat: 'F j, Y',
        });

        if (document.getElementById('passport_expiry')) {
          flatpickr('#passport_expiry', {
            dateFormat: 'Y-m-d',
            minDate: 'today',
            disableMobile: true,
            altInput: true,
            altFormat: 'F j, Y',
          });
        }

        if (document.getElementById('arrival_at')) {
          flatpickr('#arrival_at', {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            time_24hr: true,
            disableMobile: true,
            altInput: true,
            altFormat: 'F j, Y - H:i',
          });
        }

        if (document.getElementById('departure_at')) {
          flatpickr('#departure_at', {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            time_24hr: true,
            disableMobile: true,
            altInput: true,
            altFormat: 'F j, Y - H:i',
          });
        }
      }
    });
  </script>
@endsection
