<!DOCTYPE html>

<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>San Rafael Admin - Login</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />

    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<body
    class="bg-background text-on-background min-h-screen flex items-center justify-center selection:bg-secondary/20 selection:text-on-background">
    <main class="w-full h-screen flex flex-col md:flex-row">
        <!-- Left Side: Immersive Image -->
        <section class="hidden md:flex w-full md:w-1/2 lg:w-3/5 relative bg-primary-900 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900/90 via-primary-900/35 to-primary-800/10 z-10">
            </div>
            <img alt="Spectacular fireworks display over water at night"
                class="absolute inset-0 w-full h-full object-cover"
                data-alt="dramatic wide angle shot of a massive professional fireworks display exploding in the night sky over dark water, vibrant orange and purple sparks, high contrast, cinematic lighting"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuC1_B6DWpzfIJ7m-ZYznbf0sMkBsOq0cVY206WQobjxFntd366GZ4cxaWjpzkndAJkeQoH_GFy8Qxk49KRQ3tUZ8pX0nSPeL4MUSKraBF8R7DswUWKlccJ2Ieh8wPCg0u2oLsk4Ng5frTYa8GMY04P4tQVBhnmIkq5nqr936uYow2A2bh_gPDuxVPzZdPZEcii3kpsFuiCEx2haoA-Rppnn5DTyWbX6Xr87tlUj49wVN0UnhurC2I3i45kBGa5J318-Jc10WN6i1Qs" />
            <div class="relative z-20 mt-auto p-12 lg:p-16 flex flex-col gap-4">
                <h1 class="font-display text-5xl lg:text-6xl font-extrabold tracking-tight text-on-primary leading-tight">
                    Celestial<br />Conductor<span class="text-secondary">.</span>
                </h1>
                <p class="font-body text-lg text-primary-200 max-w-md">
                    Orchestrating the sky with precision, safety, and unparalleled spectacle. Access the pyrotechnic
                    command center.
                </p>
            </div>
        </section>
        <!-- Right Side: Login Form (Using requested light/grey aesthetic for the form area, but adapting to the dark mode theme slightly to maintain "Nocturnal Elegance" overall, interpreting "clean, friendly white/light-grey" as an isolated card or panel within the dark ecosystem if strict adherence is needed, but given the "Dark Mode" mandate, I will create a high-contrast sophisticated dark surface for the form that feels clean and modern). Actually, the prompt says "On the right, a clean, friendly white/light-grey background". I must follow the prompt's structural request while balancing the dark theme mandate. I will make the right panel a very distinct surface container. Wait, "Dark Mode: The page should be in dark mode. The <html> tag class must be set to class="dark"." I will use `surface-container-low` for the right panel to keep it within the dark theme but distinct from the image, ensuring it feels "clean" and "modern". -->
        <section
            class="w-full md:w-1/2 lg:w-2/5 h-full flex items-center justify-center bg-surface p-8 text-on-surface sm:p-12 lg:p-16 relative z-20 shadow-2xl shadow-primary-900/15 md:shadow-none">
            <div class="w-full max-w-md flex flex-col gap-12">
                <!-- Brand Header -->
                <div class="flex flex-col gap-2">
                    <div
                        class="text-primary font-headline font-black tracking-widest uppercase text-2xl flex items-center gap-3">
                        <span class="material-symbols-outlined text-3xl"
                            style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                        San Rafael
                    </div>
                    <p class="mt-2 font-body text-sm text-muted">Admin Portal Login</p>
                </div>
                <!-- Form Area -->
                <form action="{{ route('login.submit') }}" class="flex flex-col gap-6" method="POST">
                    @csrf
                    <div class="flex flex-col gap-5">
                        <!-- Email Input -->
                        <div class="flex flex-col gap-2">
                            <label class="font-body text-sm font-medium text-on-surface" for="email">Email
                                Address</label>
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-muted group-focus-within:text-accent transition-colors">mail</span>
                                <input
                                    class="w-full rounded-lg border border-border bg-surface-alt py-3.5 pl-12 pr-4 font-body text-sm text-on-surface transition-all placeholder:text-muted focus:border-accent focus:bg-surface focus:outline-none focus:ring-2 focus:ring-accent/20"
                                    id="email" name="email" placeholder="operator@sanrafael.com" type="email"
                                    value="{{ old('email') }}" />
                            </div>
                            @error('email')
                                <p class="font-body text-xs font-medium text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Password Input -->
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between items-center">
                                <label class="font-body text-sm font-medium text-on-surface"
                                    for="password">Password</label>
                                <a class="text-xs font-medium text-primary hover:text-secondary transition-colors"
                                    href="#">Forgot Password?</a>
                            </div>
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-muted group-focus-within:text-accent transition-colors">lock</span>
                                <input
                                    class="w-full rounded-lg border border-border bg-surface-alt py-3.5 pl-12 pr-4 font-body text-sm text-on-surface transition-all placeholder:text-muted focus:border-accent focus:bg-surface focus:outline-none focus:ring-2 focus:ring-accent/20"
                                    id="password" name="password" placeholder="••••••••••••" type="password" />
                                <button aria-controls="password" aria-label="Mostrar u ocultar contraseña"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-muted hover:text-primary transition-colors"
                                    data-password-toggle type="button">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="font-body text-xs font-medium text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @if (session('status'))
                        <div
                            class="rounded-lg border border-accent/20 bg-accent/10 px-4 py-3 font-body text-sm font-medium text-accent">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Remember Me -->
                    <div class="flex items-center gap-3 mt-2">
                        <input
                            class="h-4 w-4 rounded border border-border bg-surface-alt text-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                            id="remember" name="remember" type="checkbox" value="1"
                            @checked(old('remember')) />
                        <label class="font-body text-sm text-muted select-none cursor-pointer"
                            for="remember">Keep me logged in</label>
                    </div>
                    <!-- Actions -->
                    <div class="mt-6">
                        <button
                            class="relative flex w-full items-center justify-center gap-2 overflow-hidden rounded-lg bg-secondary py-4 transition-all hover:bg-secondary-600 active:scale-[0.98]"
                            type="submit">
                            <!-- Inner glow effect requested in DS -->
                            <div class="absolute inset-x-0 top-0 h-1/2 bg-gradient-to-b from-on-secondary/20 to-transparent">
                            </div>
                            <span class="font-headline font-bold text-on-primary text-base relative z-10">Access
                                Console</span>
                            <span
                                class="material-symbols-outlined text-on-primary relative z-10 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                    </div>
                </form>
                <!-- Footer elements inside panel -->
                <div class="mt-auto border-t border-border pt-8 text-center">
                    <p class="font-body text-xs text-muted opacity-80">
                        Secure connection encrypted. Authorized personnel only.
                    </p>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.querySelector('[data-password-toggle]');
            const passwordInput = document.getElementById('password');

            if (!toggleButton || !passwordInput) {
                return;
            }

            toggleButton.addEventListener('click', () => {
                const isHidden = passwordInput.type === 'password';
                passwordInput.type = isHidden ? 'text' : 'password';
                const icon = toggleButton.querySelector('.material-symbols-outlined');

                if (icon) {
                    icon.textContent = isHidden ? 'visibility_off' : 'visibility';
                }
            });
        });
    </script>
</body>

</html>
