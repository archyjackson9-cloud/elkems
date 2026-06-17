@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- ===================================================
     HERO SECTION
===================================================== --}}
<section id="hero"
    @if($hero && $hero->background_image)
        style="background-image:url('{{ asset('storage/'.$hero->background_image) }}')"
    @endif
>
    <div class="overlay"></div>
    <div class="container text-center text-white hero-content py-5">
        <h1 class="mb-3">{{ $hero->heading ?? 'ELD Solutions Ltd' }}</h1>
        <p class="mb-5 opacity-85">{{ $hero->subheading ?? 'Delivering Excellence Across Every Project' }}</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ $hero->button_primary_url ?? '#services' }}"
               class="btn btn-eld btn-lg px-5 py-3 fw-semibold rounded-1">
                {{ $hero->button_primary_text ?? 'Our Services' }}
            </a>
            <a href="{{ $hero->button_secondary_url ?? '#contact' }}"
               class="btn btn-eld-outline btn-lg px-5 py-3 fw-semibold rounded-1">
                {{ $hero->button_secondary_text ?? 'Contact Us' }}
            </a>
        </div>
    </div>
</section>


{{-- ===================================================
     TRUSTED BY
===================================================== --}}
@if($clients->count())
<section id="trusted" class="py-5">
    <div class="container">
        <p class="trusted-label text-center mb-4">TRUSTED BY</p>
        <div class="clients-grid">
            @foreach($clients->take(8) as $client)
            <div class="clients-grid-item">
                @if($client->website_url)
                    <a href="{{ $client->website_url }}" target="_blank" rel="noopener"
                       class="client-logo-card text-decoration-none d-flex flex-column align-items-center">
                @else
                    <div class="client-logo-card d-flex flex-column align-items-center">
                @endif

                    @if($client->logo)
                        <img src="{{ asset('storage/'.$client->logo) }}"
                             alt="{{ $client->name }}"
                             loading="lazy"
                             onerror="this.style.display='none'">
                        <span class="client-name-label">{{ $client->name }}</span>
                    @elseif($client->logo_text)
                        <span class="logo-text-fallback" style="{{ $client->logo_style }}">
                            {!! $client->logo_text !!}
                        </span>
                        <span class="client-name-label">{{ $client->name }}</span>
                    @else
                        <span class="logo-text-fallback">{{ $client->name }}</span>
                    @endif

                @if($client->website_url)
                    </a>
                @else
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ===================================================
     ABOUT
===================================================== --}}
<section id="about">
    <div class="py-5">
        <div class="container text-center">
            <h2 class="section-heading mb-4">About</h2>
            <p class="about-text text-muted mx-auto" style="max-width:780px">
                {{ $about->description ?? 'ELD Solutions Ltd is a Ghanaian owned professional project management company incorporated in 2011.' }}
            </p>
        </div>
    </div>

    {{-- Mission Statement Banner --}}
    <div class="mission-block">
        <div class="container">
            <div class="quote-mark">&ldquo;</div>
            <blockquote class="mt-3">
                {{ $about->mission_statement ?? 'To enhance customer satisfaction through continuous improvement in business deliverables with recognition to safety and quality of our business.' }}
            </blockquote>
        </div>
    </div>

    <div class="py-4"></div>
</section>


{{-- ===================================================
     SERVICES
===================================================== --}}
<section id="services" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-heading">Our Services</h2>
            <p class="section-sub mt-3">We deliver world-class solutions across four core practice areas.</p>
        </div>

        @if($services->count())
        <div class="row g-4">
            @foreach($services as $index => $service)
            <div class="col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        @if($service->icon)
                            <i class="bi bi-{{ $service->icon }}"></i>
                        @else
                            @php
                                $icons = ['link-45deg','building','briefcase','leaf'];
                            @endphp
                            <i class="bi bi-{{ $icons[$index % 4] }}"></i>
                        @endif
                    </div>
                    <h4>{{ $service->title }}</h4>
                    <p class="text-muted">{{ $service->description }}</p>

                    @if($service->badges)
                    <div class="mt-3">
                        @foreach($service->badges as $i => $badge)
                        <span class="badge-circle {{ $i % 2 === 0 ? 'badge-primary-eld' : 'badge-secondary-eld' }}">
                            {{ $badge }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-muted">Services coming soon.</p>
        @endif
    </div>
</section>


{{-- ===================================================
     TEAM
===================================================== --}}
<section id="team" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-heading">The Management Team</h2>
            <p class="section-sub mt-3">We believe in a diverse range of personnel to bring creative skills, thoughts, and ideas to the table.</p>
        </div>

        @if($team->count())
        <div class="row g-4 justify-content-center">
            @foreach($team as $member)
            <div class="col-md-6 col-lg-4">
                <div class="team-card">
                    <div class="team-avatar">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                        @else
                            {{ $member->initials }}
                        @endif
                    </div>
                    <h5>{{ $member->name }}</h5>
                    <p class="role">{{ $member->position }}</p>
                    @if($member->bio)
                    <p class="text-muted">{{ $member->bio }}</p>
                    @endif
                    @if($member->linkedin_url || $member->twitter_url)
                    <div class="mt-3">
                        @if($member->linkedin_url)
                        <a href="{{ $member->linkedin_url }}" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        @endif
                        @if($member->twitter_url)
                        <a href="{{ $member->twitter_url }}" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-muted">Team information coming soon.</p>
        @endif
    </div>
</section>


{{-- ===================================================
     CLIENTS (Full Section)
===================================================== --}}
<section id="clients" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-heading">Our Clients</h2>
            <p class="section-sub mt-3">We are proud to have partnered with leading organizations across Ghana and beyond.</p>
        </div>

        @if($clients->count())
        <div class="clients-grid mb-5">
            @foreach($clients as $client)
            <div class="clients-grid-item">
                @if($client->website_url)
                    <a href="{{ $client->website_url }}" target="_blank" rel="noopener"
                       class="client-logo-card text-decoration-none d-flex flex-column align-items-center">
                @else
                    <div class="client-logo-card d-flex flex-column align-items-center">
                @endif

                    @if($client->logo)
                        <img src="{{ asset('storage/'.$client->logo) }}"
                             alt="{{ $client->name }}"
                             loading="lazy"
                             onerror="this.style.display='none'">
                        <span class="client-name-label">{{ $client->name }}</span>
                    @elseif($client->logo_text)
                        <span class="logo-text-fallback" style="{{ $client->logo_style }}">
                            {!! $client->logo_text !!}
                        </span>
                        <span class="client-name-label">{{ $client->name }}</span>
                    @else
                        <span class="logo-text-fallback">{{ $client->name }}</span>
                    @endif

                @if($client->website_url)
                    </a>
                @else
                    </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-muted mb-5">Client information coming soon.</p>
        @endif
    </div>

    {{-- CTA Banner --}}
    <div class="cta-banner">
        <p>Ready to work with us? Let&rsquo;s build something great together.</p>
        <a href="#contact" class="btn btn-outline-light fw-semibold">Get In Touch</a>
    </div>
</section>


{{-- ===================================================
     CONTACT
===================================================== --}}
<section id="contact" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-heading">Contact Us</h2>
            <p class="section-sub mt-2">Connect with us!</p>
        </div>

        @if($errors->any())
        <div class="alert alert-danger auto-dismiss">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <div class="row g-5">
            {{-- Contact Form --}}
            <div class="col-lg-7">
                <form action="{{ route('contact.send') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Your Name <span class="text-eld">(Required)</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Your Email <span class="text-eld">(Required)</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                               value="{{ old('subject') }}">
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Your Message</label>
                        <textarea name="message" rows="6"
                                  class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn-send">Send Message</button>
                </form>
            </div>

            {{-- Contact Info --}}
            <div class="col-lg-5">
                <div class="text-center mb-4">
                    <div class="d-inline-flex flex-column gap-2">
                        <span class="logo-square mx-auto" style="width:54px;height:54px;font-size:22px">E</span>
                        <span class="logo-square mx-auto" style="width:54px;height:54px;font-size:22px">L</span>
                        <span class="logo-square mx-auto" style="width:54px;height:54px;font-size:22px">D</span>
                        <div style="letter-spacing:4px;font-size:.7rem;color:#3DBDA0" class="mt-1">SOLUTIONS</div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3">
                    @if($settings['phone'])
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-telephone-fill contact-icon fs-5"></i>
                        <span>{{ $settings['phone'] }}</span>
                    </div>
                    @endif
                    @if($settings['email'])
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-envelope-fill contact-icon fs-5"></i>
                        <a href="mailto:{{ $settings['email'] }}" class="text-eld text-decoration-none">{{ $settings['email'] }}</a>
                    </div>
                    @endif
                    @if($settings['address'])
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-geo-alt-fill contact-icon fs-5"></i>
                        <span>{{ $settings['address'] }}</span>
                    </div>
                    @endif
                </div>

                <div class="mt-4">
                    @if($settings['linkedin'])
                    <a href="{{ $settings['linkedin'] }}" class="social-link" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if($settings['twitter'])
                    <a href="{{ $settings['twitter'] }}" class="social-link" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i></a>
                    @endif
                    @if($settings['facebook'])
                    <a href="{{ $settings['facebook'] }}" class="social-link" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                    @endif
                </div>
            </div>
        </div>

        @if(!empty($settings['google_maps_embed']))
        <div class="mt-5 rounded overflow-hidden" style="height:300px">
            <iframe src="{{ $settings['google_maps_embed'] }}"
                    width="100%" height="300" style="border:0;display:block"
                    allowfullscreen loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        @endif
    </div>
</section>

@endsection
