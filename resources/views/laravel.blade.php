@extends('layouts.app')

@section('styles')

    <style>

        .custom-border{
            border-width: 2px;
            border-color: black;
        }

        [x-cloak] { display: none !important; }

    </style>

@endsection

@section('content')

    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0"></div>
{{-- Container Main --}}
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
{{-- Div Left Top --}}
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a x-data="{ message: 'I ❤️ Alpine' }" x-text="message" @click.prevent href="#" class="underline text-gray-900 dark:text-white"></a>
                                </div>
                            </div>

                            <div class="ml-12">
                                <div x-data="{ count: 0 }" class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    <button x-on:click="count++" class="bg-slate-100 mr-2">숫자 증가 버튼</button>
                                    <span x-text="count" ></span>
                                </div>
                            </div>

                            <div class="ml-12">
                                <button x-data="{}" x-on:click="console.log('clicked')">콘솔 clicked 출력</button>
                                <button x-data="{}" @click="alert('Hello World!')">Say Hi</button>
                                <button x-data="{}" @click="alert('I\'ve been clicked!')">Click Me</button>
                            </div>
                            <div class="ml-12">
                                <input @keyup.enter="엔터" class="border-2 border-black rounded-md">
                            </div>
                            <div class="ml-12">
                                <button x-data="{}" @click="$event.target.remove()">Remove Me</button>
                            </div>
                            <div x- class="ml-12">
                                <div x-data="{ foo: 'bar' }">
                                    <span x-text="foo"><!-- Will output: "bar" --></span>

                                    <div x-data="{ bar: 'baz' }">
                                        <span x-text="foo"><!-- Will output: "bar" --></span>

                                        <div x-data="{ foo: 'bob' }">
                                            <span x-text="foo"><!-- Will output: "bob" --></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{ open: false, trans() { this.open = ! this.open } }" class="ml-12">
                                <button @click="trans()">Toggle Content</button>

                                <div x-show="open">
                                    Content...
                                </div>
                            </div>
                            <div x-data="{ open: false, get isOpen() { return this.open }, trans() { this.open = ! this.open } }" class="ml-12">
                                <button @click="trans()">Toggle Content</button>

                                <div x-show="isOpen">
                                    Content...
                                </div>
                            </div>
                            <div x-data="{ open: true }" class="ml-12">
                                <button @click="open = false" x-show="open">숨김버튼</button>
                            </div>
                            <button x-data="{ open: true }" @click="open = false" x-show="open" class="ml-12">숨김버튼 단일</button>
                            <div x-data="dropdown" class="ml-12">
                                <button @click="toggle">선택 버튼</button>
                                <div x-show="open">
                                    Content...,,,
                                </div>
                            </div>
                            <script>
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('dropdown', () => ({
                                        open: false,
                                        toggle(){
                                            this.open = !this.open
                                        },
                                        init() {
                                            console.log('I will get evaluated when initializing each "dropdown" component.')
                                        },
                                    }))
                                })
                            </script>
                            <div x-init="console.log('I\'m being initialized!')"></div>
                            <div x-data>
                                <span x-init="console.log('I can initialize')"></span>
                            </div>
                            <span x-init="console.log('I can initialize too')"></span>
                            <div x-data="{ init(){ console.log('I am called automatically')} }"></div>
                            <div x-data @foo="alert('Button Was Clicked!')" class="ml-12">
                                <button @click="$event.target.dispatchEvent(new CustomEvent('foo', { bubbles:true }))">event.target.dispatchEvent 버튼</button>
                                <button @click=$dispatch('foo')>$dispatch 버튼</button>
                            </div>
                            <form @submit.prevent="console.log('submitted')" action="/foo" class="ml-12">
                                <button>제출!</button>
                            </form>
                            <div x-data @click="console.log('로그되지 않을 것.')" class="ml-12">
                                <button @click.stop class="mr-4">click stop</button>
                                <button @click>click</button>
                            </div>
                            <div x-data="{ open: false }" class="ml-12">
                                <button @click="open = !open">토글버튼</button>
                                <div x-show="open" x-transition.duration.500ms @click.outside="open = false">
                                    콘텐츠 내용
                                </div>
                            </div>
                            <div @keyup.escape.window="..." class="ml-12">...</div>
                            <button x-data @click.once="console.log('한번만 콘솔에 입력된다.')" class="ml-12">한번 콘솔 입력 버튼</button>
                            <div x-data="{ username: 'x-text' }" class="ml-12">
                                name: <strong x-text="username"></strong>
                            </div>
                            <div x-data="{ username: '<strong>x-html</strong>' }" class="ml-12">
                                name: <span x-html="username"></span>
                            </div>
                            <div x-data="{ color: '' }" class="ml-12">
                                <select x-model="color" class="mr-2">
                                    <template x-for="color in ['Red', 'Orange', 'Yellow']">
                                        <option x-text="color"></option>
                                    </template>
                                </select>
                                Color: <span x-text="color"></span>
                            </div>
                            <div x-data="{ username: '', age: '', filltest: '기본 메시지' }" class="ml-12 text-green-600 bg-red-300">
                                <input type="text" x-model.lazy="username" class="border-2 border-black rounded-md">
                                <span x-show="username.length > 20">유저 이름이 너무 깁니다.</span><br>
                                <input type="text" x-model.number="age">
                                <span x-text="typeof age"></span><br>
                                <input type="text" x-model.fill="filltest">
                                <span x-text="filltest"></span>
                            </div>
                            <div x-data="{ uname: 'chkim' }" class="ml-12">
                                <div x-ref="div" x-model="uname"></div>
                                <button @click="$refs.div._x_model.set('windowlife')">
                                    Change uname to: 'windowlife'
                                </button>
                                <span x-text="$refs.div._x_model.get()" class="underline ml-2 text-purple-700 bg-yellow-300"></span>
                            </div>

                        </div>
{{-- Div Right Top --}}
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a x-data="{ message1: 'Alpine 💯 💋' }" x-text="message1" @click.prevent href="#" class="underline text-gray-900 dark:text-white"></a>
                                </div>
                            </div>

                            <div class="ml-12">
                                <div
                                    x-data="{
                                        search: '',

                                        items: ['foo', 'bar', 'baz'],

                                        get filteredItems() {
                                            return this.items.filter(
                                                i => i.startsWith(this.search)
                                            )
                                        }
                                    }"
                                    x-init="$watch('search', value => console.log('search changed:', value))"
                                >
                                    <input x-model="search" class="border-2 border-black mb-2" placeholder="검색...">
                                    <input class="border-2 border-black">
                                    <input x-model="search" class="border-2 border-orange-600">

                                    <ul>
                                        <template x-for="item in filteredItems" :key="item">
                                            <li x-text="item"></li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                            <div x-data="{ open: false }" class="ml-12">
                                <button @click="open = ! open">Expand</button>

                                <template x-if="open">
                                    <div>
                                        Content...
                                    </div>
                                </template>
                            </div>
                            <div x-data="{ open: false }" class="ml-12">
                                <button @click="open = ! open">Expands</button>

                                <div x-show="open" x-transition.duration.500ms>
                                    Content...
                                </div>
                            </div>
                            <div class="ml-12">
                                <button x-data="{ label: 'Click Here' }" x-text="label"></button>
                            </div>
                            <div class="ml-12">
                                <button x-data @click="alert('I\'ve been clicked!')">Click Me</button>
                            </div>
                            <div class="ml-12" @foo="console.log('foo was dispatched')">
                                <button @click="$dispatch('foo')">foo</button>
                            </div>
                            <div x-data @foo.window="console.log('foo was dispatched')" class="ml-12">window</div>
                            <div class="ml-12" @foo="console.log('foo was dispatched')">
                                <button x-init="console.log('Im initing')">Im initing</button>
                            </div>
                            <script>
                                console.log('log test');
                            </script>
                            <div x-data="{ message: '', show: false }" class="ml-12">
                                <input type="text" x-model="message" class="border-2 border-black rounded-md"><br>
                                <span x-text="message"></span><br>
                                <button x-on:click="message = 'chaged'">메시지 바꾸기(chaged)</button><br>
                                <input type="checkbox" id="checkbox" x-model="show">
                                <label for="checkbox" x-text="show"></label>
                            </div>
                            <div x-data="{ colors: [], answer: '' }" class="ml-12">
                                <input type="checkbox" value="red" x-model="colors">
                                <input type="checkbox" value="orange" x-model="colors">
                                <input type="checkbox" value="yellow" x-model="colors"><br>
                                Colors: <span x-text="colors"></span><br>
                                <input type="radio" value="yes" x-model="answer">
                                <input type="radio" value="no" x-model="answer"><br>
                                Answer: <span x-text="answer"></span>
                            </div>
                            <div x-data="{ color: '' }">
                                <select x-model="color" multiple class="ml-12">
                                    <option value="" disabled>Select A Color</option>
                                    <option>Red</option>
                                    <option>Green</option>
                                    <option>Blue</option>
                                </select>
                                Color: <span x-text="color"></span>
                            </div>

                        </div>
{{-- Div Left Bottom --}}
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a x-data="{ message1: 'Practice! 🧑 🚄' }" x-text="message1" @click.prevent href="#" class="underline text-gray-900 dark:text-white"></a>
                                </div>
                            </div>

                            <div x-data="{ title: 'Start Here' }" class="ml-12 mb-4">
                                <h1 x-text="title"></h1>
                                <span x-text="1 + 2"></span>
                            </div>

                            <div class="ml-12">
                                <button
                                    x-data="{ red: false }"
                                    x-bind:class="red ? 'bg-red-200' : ''"
                                    @click="red = ! red"
                                    class="border-2 border-black rounded-md p-2"
                                >
                                    빨간색 전환 버튼
                                </button>
                            </div>
                            <div x-data="{ statuses: ['open', 'closed', 'archived'] }" class="ml-12">
                                <template x-for="status in statuses">
                                    <div x-text="status"></div>
                                </template>
                            </div>
                            <div x-data="{ title: '<h1>Start Here</h1>' }" class="ml-12">
                                <div x-html="title"></div>
                            </div>
                            <div x-data="{ open: false }" class="ml-12">
                                <button x-on:click="open = !open">드롭박스</button>
                                <div x-bind:class="open ? '' : 'hidden'">
                                    드롭 컨텐츠
                                </div>
                            </div>
                            <div x-data="dropdown2()" class="ml-12">
                                <button x-bind="trigger">Open Dropdown</button>
                                <span x-bind="dialogue">Dropdown Contents</span>
                            </div>
                            <script>
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('dropdown2', () => ({
                                        open: false,

                                        trigger: {
                                            ['x-ref']: 'trigger',
                                            ['@click'](){
                                                this.open = true
                                            },
                                        },

                                        dialogue: {
                                            ['x-show'](){
                                                return this.open
                                            },
                                            ['@click.outside'](){
                                                this.open = false
                                            },
                                        },
                                    }))
                                })
                            </script>
                            <div x-data class="ml-12">
                                <button @click="alert($event.target.getAttribute('message'))" message="안녕 세계!">세이 하이</button>
                                <input type="text" @keyup.enter="alert('Submitted!')" class="border-2 border-black">
                                <input type="text" @keyup.shift.enter="alert('Submitted!')" class="border-2 border-black">
                            </div>
                            <div x-data="{ open1: false,  open2: false}" class="ml-12">
                                <button x-on:click="open1 = !open1">전환버튼1</button>
                                <span x-show="open1"
                                    x-transition:enter.duration.600ms
                                    x-transition:leave.duration.200ms
                                >
                                    Hello 👋 🚗
                                </span>
                                <button x-on:click="open2 = !open2">전환버튼2</button>
                                <span x-show="open2" x-transition.delay.500ms>
                                    ✋ 🍚
                                </span>
                            </div>
                            <div x-data="{ label: 'Hello', label2: 'user' }" x-effect="console.log(label, label2)" class="ml-12">
                                <button x-on:click="label += ' World!', label2 += ' chkim'">메시지 변경</button>
                            </div>
                            <div x-data="{ label: 'From Alpine' }" class="ml-12">
                                <div x-ignore>
                                    <span x-text="label"></span>
                                </div>
                                <div>
                                    <span x-text="label"></span>
                                </div>
                            </div>
                            <div x-data="" class="ml-12">
                                <button x-on:click="$refs.text.remove()">Remove Text</button>
                                <span x-ref="text">Hello ✈️</span>
                            </div>
                            <span x-cloak x-show="false" class="ml-12">This will not 'blip' onto screen at any point</span>
                            <span x-cloak x-teleport="message"></span>
                            <div x-data="{ open: false }">
                                <button x-on:click="open = !open" class="ml-12 bg-blue-400 text-white rounded-md p-2">전환 모달 버튼1</button>
                                <template x-teleport="#here">
                                    <div x-show="open" class="bg-blue-400 text-white">
                                        Modal contents 텔레포트!
                                    </div>
                                </template>
                            </div>
                            <div x-data="{ open: false }">
                                <button x-on:click="open = !open" class="ml-12 bg-green-400 text-white rounded-md p-2"> 전환 모달 버튼2</button>
                                <template x-teleport=".tele">
                                    <div x-show="open" x-on:click="open = false" class="bg-green-400 text-white">
                                        Modal contents 텔레포트!<br>
                                        닫으려면 클릭하세요.
                                    </div>
                                </template>
                            </div>
                            <div x-data="{ open: false }" class="ml-12">
                                <button x-on:click="open = !open" class="bg-red-400 text-white rounded-md p-2">중첩 전환 버튼1</button>
                                <template x-teleport="#here">
                                    <div x-show="open" class="bg-red-400">
                                        중첩 텔레포트1
                                        <div x-data="{ open: false }">
                                            <button x-on:click="open = !open" class="bg-red-300 text-white rounded-md p-1">중첩 전환 버튼2</button>
                                            <template x-teleport=".tele">
                                                <div x-show="open" class="bg-red-300">
                                                    Nested modal contents...
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div id="here" class="tele ml-12">...x-teleport를 이용해서...</div>
                            <div class="ml-12">컨텐츠 위치를 옮겨 봅시다.</div>

                        </div>
{{-- Div Right Bottom --}}
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a x-data="{ message1: 'Directives! 💠 🇩🇬' }" x-text="message1" @click.prevent href="#" class="underline text-gray-900 dark:text-white"></a>
                                </div>
                            </div>

                            <div class="ml-12" x-data="{ number: 5 }">
                                <div x-data="{ count: 0 }" x-modelable="count" x-model="number">
                                    <button @click="count++" class="border-2 bg-black text-white">증가 버튼</button>
                                    Number: <span x-text="number"></span>
                                </div>
                            </div>
                            <div x-data="{ colors: ['RedI', 'OrangeI', 'YellowI'] }" class="ml-12">
                                <template x-for="(color, index) in colors">
                                    {{-- <li x-text="color"></li> --}}
                                    <li>
                                        <span x-text="index + ': '"></span>
                                        <span x-text="color"></span>
                                    </li>
                                </template>
                            </div>
                            <div class="ml-12">
                                <ul x-data="{ colors: [
                                    { id: 1, label: 'Red' },
                                    { id: 2, label: 'Orange' },
                                    { id: 3, label: 'Yellow' },
                                ] }">
                                    <template x-for="color in colors" :key="color.id">
                                        <li x-text="color.label"></li>
                                    </template>
                                </ul>
                            </div>
                            <div class="ml-12">
                                <ul x-data>
                                    <template x-for="a in 5">
                                        <li x-text="a + ' 번째'"></li>
                                    </template>
                                </ul>
                            </div>
                            <div x-data="{ open: true }" class="ml-12">
                                <template x-if="open">
                                    <div>X_IF 컨텐츠</div>
                                </template>
                            </div>
                            <div x-id="['text-input']" class="ml-12">
                                <label :for="$id('text-input')">Username</label>
                                <input type="text" :id="$id('text-input')" class="border-2 border-black">
                            </div>

                        </div>
{{-- Div Bottom Left --}}
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a x-data="{ message1: 'Magics! 🤷‍♂️🪄' }" x-text="message1" @click.prevent href="#" class="underline text-gray-900 dark:text-white"></a>
                                </div>
                            </div>


                        </div>
{{-- Div Bottom Right --}}
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a x-data="{ message1: 'Globals! 🌐' }" x-text="message1" @click.prevent href="#" class="underline text-gray-900 dark:text-white"></a>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
{{-- Container Bottom --}}
                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>

@endsection

@push('script')
<script>

</script>
@endpush
