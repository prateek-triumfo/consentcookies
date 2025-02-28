<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-4 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="p-6 md:p-4 rounded-lg bg-white shadow-lg border border-gray-200">
            <div class="flex items-start justify-between flex-wrap">
                <!-- Message Section -->
                <div class="max-w-full flex-1 items-center md:w-0 md:inline">
                    <p class="md:ml-3 text-black text-lg font-semibold cookie-consent__message">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                    <p class="mt-2 text-sm text-gray-500">
                        We usees cookies to improve your experience. Select which cookies you'd like to allow.
                    </p>
                </div>

                <!-- Cookies Preferences Section -->
                <div class="mt-4 w-full sm:mt-0 sm:w-auto">
                    <form id="cookie-consent-form"> 
                    @csrf

                    <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="checkbox" id="necessary" name="cookies[1]" value="1" class="h-5 w-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500">
                                <label for="necessary" class="ml-2 text-sm text-gray-700">Necessary Cookies</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="preferences" name="cookies[2]" value="1" class="h-5 w-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500">
                                <label for="preferences" class="ml-2 text-sm text-gray-700">Preferences Cookies</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="statistics" name="cookies[3]" value="1" class="h-5 w-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500">
                                <label for="statistics" class="ml-2 text-sm text-gray-700">Statistics Cookies</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="marketing" name="cookies[4]" value="1" class="h-5 w-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500">
                                <label for="marketing" class="ml-2 text-sm text-gray-700">Marketing Cookies</label>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex justify-end">
                            <button type="submit" name="consent_given" value="1" class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-6 py-2 rounded-md text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                {{ trans('cookie-consent::texts.agree') }}
                            </button>
                         
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

