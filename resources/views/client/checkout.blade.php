<x-layouts.client>
    <x-slot name="title">結帳 - 藝文售票平台</x-slot>

    <!-- 主內容區域 -->
    <div class="py-12 bg-neutral-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- 左側購票表單 -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold text-zinc-900 mb-4">購票人資訊</h2>
                        
                        <form>
                            <div class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-zinc-700 mb-1">姓名</label>
                                    <input type="text" id="name" name="name" required class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-zinc-700 mb-1">電子郵件</label>
                                    <input type="email" id="email" name="email" required class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                    <p class="mt-1 text-sm text-zinc-500">用於接收電子票券和訂單確認</p>
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-zinc-700 mb-1">聯絡電話</label>
                                    <input type="tel" id="phone" name="phone" required class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                
                                <div class="border-t border-zinc-200 pt-6">
                                    <h3 class="text-lg font-medium text-zinc-900 mb-4">活動自訂欄位</h3>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="emergency_contact" class="block text-sm font-medium text-zinc-700 mb-1">緊急聯絡人</label>
                                            <input type="text" id="emergency_contact" name="emergency_contact" class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        </div>
                                        
                                        <div>
                                            <label for="emergency_phone" class="block text-sm font-medium text-zinc-700 mb-1">緊急聯絡人電話</label>
                                            <input type="tel" id="emergency_phone" name="emergency_phone" class="block w-full px-4 py-2 border border-zinc-300 rounded-md bg-white text-zinc-900 shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-zinc-700 mb-1">飲食偏好</label>
                                            <div class="mt-2 space-y-2">
                                                <div class="flex items-center">
                                                    <input id="diet_normal" name="diet" type="radio" value="normal" checked class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-zinc-300">
                                                    <label for="diet_normal" class="ml-2 block text-sm text-zinc-600">葷食</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="diet_vegetarian" name="diet" type="radio" value="vegetarian" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-zinc-300">
                                                    <label for="diet_vegetarian" class="ml-2 block text-sm text-zinc-600">素食</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-zinc-900 mb-4">付款方式</h2>
                        
                        <div class="space-y-6">
                            <div class="bg-neutral-100 rounded-lg p-4">
                                <div class="flex items-center">
                                    <input id="payment_credit" name="payment" type="radio" value="credit" checked class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-zinc-300">
                                    <label for="payment_credit" class="ml-2 block text-sm text-zinc-900">信用卡 / 金融卡</label>
                                </div>
                                <div class="mt-2 ml-6">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-block w-8 h-5 bg-zinc-300 rounded"></span>
                                        <span class="inline-block w-8 h-5 bg-zinc-300 rounded"></span>
                                        <span class="inline-block w-8 h-5 bg-zinc-300 rounded"></span>
                                        <span class="inline-block w-8 h-5 bg-zinc-300 rounded"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-neutral-100 rounded-lg p-4">
                                <div class="flex items-center">
                                    <input id="payment_atm" name="payment" type="radio" value="atm" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-zinc-300">
                                    <label for="payment_atm" class="ml-2 block text-sm text-zinc-900">ATM 轉帳</label>
                                </div>
                            </div>
                            
                            <div class="bg-neutral-100 rounded-lg p-4">
                                <div class="flex items-center">
                                    <input id="payment_cvs" name="payment" type="radio" value="cvs" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-zinc-300">
                                    <label for="payment_cvs" class="ml-2 block text-sm text-zinc-900">超商代碼繳費</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- 右側訂單摘要 -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-8">
                        <h2 class="text-xl font-bold text-zinc-900 mb-4">訂單摘要</h2>
                        
                        <div class="mb-6">
                            <h3 class="font-medium text-lg text-zinc-900 mb-2">2025 台北春季音樂會</h3>
                            <div class="text-sm text-zinc-600 mb-2">2025-01-15 19:30 - 21:30</div>
                            <div class="text-sm text-zinc-600">台北國家音樂廳</div>
                        </div>
                        
                        <div class="border-t border-zinc-200 py-4">
                            <h4 class="font-medium text-zinc-900 mb-2">已選票券</h4>
                            
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <div class="text-zinc-600">全票 x 2</div>
                                    <div class="text-zinc-900">NT$ 1,000</div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="text-zinc-600">學生票 x 1</div>
                                    <div class="text-zinc-900">NT$ 300</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-zinc-200 py-4">
                            <div class="flex justify-between items-center font-medium text-zinc-900">
                                <div>總金額</div>
                                <div>NT$ 1,300</div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-zinc-300">
                                    <label for="terms" class="ml-2 block text-sm text-zinc-600">
                                        我已閱讀並同意<a href="#" class="text-purple-600 hover:underline">服務條款</a>與<a href="#" class="text-purple-600 hover:underline">退票政策</a>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-purple-600 text-white rounded-md font-medium hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                確認訂單並前往付款
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.client> 