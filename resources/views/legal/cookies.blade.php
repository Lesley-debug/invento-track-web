<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Policy — Invento Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>* { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-900">Invento Track</span>
            </a>
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-gray-900">Back to home</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-16">
        <div class="bg-white rounded-2xl border border-gray-200 p-8 md:p-12 shadow-sm">

            <div class="mb-10">
                <h1 class="text-3xl font-black text-gray-900 mb-3">Cookie Policy</h1>
                <p class="text-gray-500 text-sm">Last updated: August 2026</p>
            </div>

            <div class="space-y-8 text-sm leading-relaxed text-gray-600">

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">1. What Are Cookies?</h2>
                    <p>Cookies are small text files placed on your device when you visit a website. They are widely used to make websites work efficiently, remember your preferences, and provide information to website owners.</p>
                    <p class="mt-3">Cookies can be session cookies (deleted when you close your browser) or persistent cookies (remain on your device for a set period). We use both types.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">2. Essential Cookies</h2>
                    <p class="mb-3">These cookies are strictly necessary for the Service to function. They cannot be disabled.</p>
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-red-50 border-b border-gray-200 px-5 py-3 flex items-center justify-between">
                            <p class="font-bold text-gray-900 text-sm">Always Active</p>
                            <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Required</span>
                        </div>
                        <div class="p-5">
                            <div class="space-y-4">
                                <div class="grid grid-cols-3 gap-4 text-xs font-semibold text-gray-500 uppercase tracking-wider pb-2 border-b border-gray-100">
                                    <span>Name</span><span>Purpose</span><span>Duration</span>
                                </div>
                                <div class="grid grid-cols-3 gap-4 py-2 border-b border-gray-50 text-xs">
                                    <span class="font-mono text-indigo-600">laravel_session</span>
                                    <span class="text-gray-600">Maintains your login session</span>
                                    <span class="text-gray-500">Session</span>
                                </div>
                                <div class="grid grid-cols-3 gap-4 py-2 border-b border-gray-50 text-xs">
                                    <span class="font-mono text-indigo-600">XSRF-TOKEN</span>
                                    <span class="text-gray-600">Protects against CSRF attacks</span>
                                    <span class="text-gray-500">Session</span>
                                </div>
                                <div class="grid grid-cols-3 gap-4 py-2 text-xs">
                                    <span class="font-mono text-indigo-600">remember_web_*</span>
                                    <span class="text-gray-600">Keeps you logged in (Remember me)</span>
                                    <span class="text-gray-500">30 days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">3. Functional Cookies</h2>
                    <p class="mb-3">These cookies enhance your experience by remembering your preferences.</p>
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="bg-blue-50 border-b border-gray-200 px-5 py-3 flex items-center justify-between">
                            <p class="font-bold text-gray-900 text-sm">Functional</p>
                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Optional</span>
                        </div>
                        <div class="p-5">
                            <div class="space-y-4">
                                <div class="grid grid-cols-3 gap-4 text-xs font-semibold text-gray-500 uppercase tracking-wider pb-2 border-b border-gray-100">
                                    <span>Name</span><span>Purpose</span><span>Duration</span>
                                </div>
                                <div class="grid grid-cols-3 gap-4 py-2 text-xs">
                                    <span class="font-mono text-indigo-600">invento_prefs</span>
                                    <span class="text-gray-600">Stores UI preferences and settings</span>
                                    <span class="text-gray-500">1 year</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">4. Analytics Cookies</h2>
                    <p>We may use privacy-friendly analytics to understand how our platform is used. These collect only anonymized data — no personally identifiable information is tracked. We do not use Google Analytics or invasive advertising trackers.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">5. Third-Party Cookies</h2>
                    <div class="space-y-3 mt-3">
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                            <p class="font-semibold text-gray-800 text-sm">Google Fonts</p>
                            <p class="text-gray-500 text-xs mt-1">Serves the Inter font. May set performance cookies.</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                            <p class="font-semibold text-gray-800 text-sm">Payment Processor (Stripe)</p>
                            <p class="text-gray-500 text-xs mt-1">Sets cookies for fraud prevention and transaction security when you subscribe.</p>
                        </div>
                    </div>
                    <p class="mt-4">We do not use advertising networks, social media trackers, or retargeting cookies.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">6. How to Control Cookies</h2>
                    <p>You can control cookies through your browser settings:</p>
                    <ul class="list-disc list-inside space-y-1 ml-2 mt-3">
                        <li><strong>Chrome:</strong> Settings > Privacy and Security > Cookies</li>
                        <li><strong>Firefox:</strong> Options > Privacy and Security > Cookies</li>
                        <li><strong>Safari:</strong> Preferences > Privacy > Manage Website Data</li>
                        <li><strong>Edge:</strong> Settings > Cookies and site permissions</li>
                    </ul>
                    <div class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <p class="text-amber-800 text-sm">Warning: Blocking essential cookies will prevent you from logging in and using the Service.</p>
                    </div>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">7. Cookie Security</h2>
                    <p>All cookies set by Invento Track use the following security attributes:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li><strong>Secure flag:</strong> Cookies only transmitted over HTTPS</li>
                        <li><strong>HttpOnly flag:</strong> Session cookies cannot be accessed by JavaScript</li>
                        <li><strong>SameSite=Strict:</strong> Prevents CSRF attacks</li>
                        <li><strong>Minimal expiry:</strong> Cookies expire after the minimum necessary time</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">8. Contact</h2>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                        <p class="font-semibold text-gray-800">Invento Track</p>
                        <p>Bamenda, North West Region, Cameroon</p>
                        <p>Email: <a href="mailto:esanglesley@gmail.com" class="text-indigo-600 hover:underline">esanglesley@gmail.com</a></p>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <footer class="border-t border-gray-200 py-8 px-6 bg-white">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">2026 Invento Track. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="{{ route('privacy') }}" class="text-sm text-gray-500 hover:text-gray-900">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-sm text-gray-500 hover:text-gray-900">Terms of Service</a>
                <a href="{{ route('cookies') }}" class="text-sm text-indigo-600 font-medium">Cookie Policy</a>
            </div>
        </div>
    </footer>

</body>
</html>
