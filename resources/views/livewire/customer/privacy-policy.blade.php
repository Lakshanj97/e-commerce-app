<div class="bg-gray-50 min-h-screen pt-28 pb-16">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">Privacy Policy</span>
        </nav>

        {{-- Header --}}
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-gray-100 shadow-sm mb-10">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Legal & Compliance</span>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1 mb-3">
                Privacy Policy
            </h1>
            <p class="text-xs text-gray-400">Last updated: January 2026 &bull; SimplyTek Electronics Sri Lanka</p>

            <div class="mt-8 pt-8 border-t border-gray-100 space-y-8 text-xs text-gray-600 leading-relaxed">

                <div>
                    <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">1. Overview</h2>
                    <p>
                        At SimplyTek, your privacy is paramount. This Privacy Policy outlines how we collect, handle, store, and protect your personal data when you visit our website, register an account, or complete a purchase. We adhere to industry standards and applicable Sri Lankan digital commerce data protection regulations.
                    </p>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">2. Personal Information We Collect</h2>
                    <p class="mb-2">When you interact with SimplyTek, we may collect the following information:</p>
                    <ul class="list-disc list-inside space-y-1 pl-2">
                        <li><strong>Account Details:</strong> First name, last name, email address, contact phone number.</li>
                        <li><strong>Delivery Details:</strong> Physical street address, city, district, postal code.</li>
                        <li><strong>Order Information:</strong> Items purchased, total transaction amount, payment method preference.</li>
                        <li><strong>Communication Records:</strong> Support inquiries, feedback, and warranty claims.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">3. How We Use Your Data</h2>
                    <p class="mb-2">We use your personal data strictly for legitimate operational purposes:</p>
                    <ul class="list-disc list-inside space-y-1 pl-2">
                        <li>Processing, packaging, and dispatching your orders with logistics partners.</li>
                        <li>Sending real-time order updates, tracking numbers, and digital tax receipts.</li>
                        <li>Managing warranty registrations, customer support tickets, and returns.</li>
                        <li>Providing VIP club newsletters and secret flash sale alerts (only with explicit consent).</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">4. Payment Security & Encryption</h2>
                    <p>
                        We do <strong>not</strong> store your credit or debit card details on our local servers. Online card transactions are tokenized and processed through PCI-DSS Level 1 compliant payment gateways (such as Stripe). All communication between your web browser and our servers is encrypted using 256-bit Secure Sockets Layer (SSL) encryption.
                    </p>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">5. Third-Party Disclosures</h2>
                    <p>
                        We never sell, rent, or trade your personal information to third-party data brokers. We only share essential operational details with trusted partners necessary to fulfill your order, such as registered domestic couriers (for recipient name, address, and phone number).
                    </p>
                </div>

                <div>
                    <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">6. Your Rights & Data Erasure</h2>
                    <p>
                        You have the right to access, update, or request the deletion of your personal account information at any time. Simply log in to your <a href="{{ route('customer.account') }}" class="text-blue-600 font-bold hover:underline">My Account</a> portal or contact our data privacy officer at <a href="mailto:privacy@simplytek.com" class="text-blue-600 font-bold">privacy@simplytek.com</a>.
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>
