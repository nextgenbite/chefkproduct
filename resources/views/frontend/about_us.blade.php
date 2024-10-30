@extends('layouts.frontend')
@section('title', $title)
@section('content')


    <!-- ---- Start Category  ----- -->
    <div class="lg:mx-4 my-2 py-2 container">
        <h1 class="text-2xl my-2 lg:text-4xl  font-medium text-gray-800 uppercase text-center">
            {{ $title }}
            <hr class="w-1/4 mx-auto h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
        </h1>


        <div
            class="p-2  mx-2 lg:p-16 lg:mx-16 hover:shadow-2xl ring-0 hover:ring-2 ring-primary-light bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all ease-in-out duration-500">
            <div class="grid gap-1 grid-cols-1 lg:grid-cols-3">
                <img class=" w-56 mx-auto rounded-full shadow-lg hover:shadow-xl ring-2 ring-slate-200 dark:ring-gray-500"
                    src="{{ asset('images/static/founder-presedent.webp') }}" alt="founder">
                <div class=" lg:col-span-2">
                    <h2 class="mb-2 text-base lg:text-2xl font-semibold text-gray-900 dark:text-white">Karen Alexis Williams is the
                        Founder and
                        President of Chef K Product.</h2>

                    <p
                        class="max-w-5xl mb-3 text-xs lg:text-base text-gray-500 dark:text-gray-400 text-justify ">
                        Join us in spreading the love for unique, healthy
                        Ms. Williams, hales from the parish of Trelawny, Jamaica West Indies. The fifth of eleven children
                        of an extremely poor family in the countryside. While she was a go-getter, earning the title of the
                        local high school Home Coming Queen (1982-1984), and the parish Agricultural Farm Queen (1987). She
                        was also the founder of the Trelawny Environmental Protection Association (TEPA). Ms. Williams also
                        worked for the local sugar and rum manufacturer (Hampden Estates Ltd) as an administrative staff.
                        Before she left Jamaica, she also ran a carwash, restaurant, and bar.

                    </p>
                    <div class="flex justify-end mt-4">

                        <a href="{{ url('/karen-alexis-williams') }}"
                            class="btn px-2 py-1 lg:px-4 lg:py-2 bg-primary-light text-white rounded-lg text-end">Continue Reading</a>
                    </div>
                </div>
            </div>


        </div>
        <hr class="w-3/4 mx-auto h-0.5 my-2 lg:my-6 bg-gray-200 border-0 dark:bg-gray-700">
        <div
            class="p-2 lg:p-16 mx-2 lg:mx-16 hover:shadow-2xl ring-0 hover:ring-2 ring-primary-light bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all ease-in-out duration-500">
            <div class="grid gap-1 grid-cols-1 lg:grid-cols-3">
                <div class=" lg:col-span-2">
                    <h2 class="mb-2  text-base lg:text-2xl font-semibold text-gray-900 dark:text-white">Chef K Product: Mission Statement</h2>

                    <p
                        class="max-w-5xl mb-3 text-xs lg:text-base text-gray-500 dark:text-gray-400 text-justify">
                        Chef K mission is to tackle the changes and expectations of the consumers in the food and beverage
                        industry, by creating a Safe, Gluten Free, Non GMO, Health and Tasty product. And by Establishing a
                        dominant Market share in the health and wellness Food and beverage market, by using natural
                        ingredients, with the Slogan, “Just the way we brew it’’, organically grown and applying innovative
                        manufacturing techniques to extract all nutrients to aide in the prevention of illness that one may
                        have now, or want to prevent in the future. Chef K is introducing recipes of natural drinks from the
                        earth. We are FDA register, BBB, and Halal
                    </p>
               
                </div>
                <img class=" w-56 mx-auto rounded-full shadow-lg hover:shadow-xl ring-2 ring-slate-200 dark:ring-gray-500"
                    src="{{ asset('images/static/founder-icon.webp') }}" alt="founder">
            </div>
            <h2 class="mb-2  text-base lg:text-2xl font-semibold text-gray-900 dark:text-white">Chef K Product: Our Vision</h2>

            <p
                class="max-w-5xl text-xs lg:text-base mb-3 text-gray-500 dark:text-gray-400 text-justify ">
                Our vision is to create a product line of foods and Beverages for customers who are now eating and drinking to take care of a specific type of problem they may have now or want to prevent in the future.
            </p>

        </div>

        <hr class="w-3/4 mx-auto h-0.5 my-2 lg:my-6 bg-gray-200 border-0 dark:bg-gray-700">


        <section class="p-2 lg:p-16 rounded-lg bg-white dark:bg-gray-900 shadow-lg border border-gray-200">
            <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
                <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
                    <h2 class="mb-4 text-xl  lg:text-3xl tracking-tight font-bold text-gray-900 dark:text-white">MEET OUR TEAM MEMBERS</h2>
                    <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Explore the whole collection of open-source web components and elements built with the utility classes from Tailwind</p>
                </div> 
                <div class="grid gap-8 lg:gap-8 sm:grid-cols-2 md:grid-cols-3 ">
                    <div class="px-2 py-4 bg-white hover:bg-slate-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 group hover:shadow-xl">
                        <img class="mx-auto mb-4  w-48 h-48  rounded-full group-hover:ring-2 group-hover:ring-primary-light transition-all duration-300 ease-in-out group-hover:scale-110" src="{{asset('images/static/CEO.webp')}}" alt="Bonnie Avatar">
                        <h3 class="mb-1  text-lg lg:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Karen Williams</a>
                        </h3>
                        <p>Founder and President</p>
                        <p class="my-3 font-semibold text-sm text-gray-500">“Drink to your health from the earth. 🌎”</p>
                        <ul class="flex justify-center mt-4 space-x-4">
                            <li>
                                <a href="#" class="text-[#39569c] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-[#00acee] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-900 hover:text-gray-900 dark:hover:text-white dark:text-gray-300">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-[#ea4c89] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" /></svg>
                                </a> 
                            </li> 
                        </ul>
                      
                    </div>
                    <div class="px-2 py-4 bg-white hover:bg-slate-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 group hover:shadow-xl">
                        <img class="mx-auto mb-4  w-48 h-48  rounded-full group-hover:ring-2 group-hover:ring-primary-light transition-all duration-300 ease-in-out group-hover:scale-110" src="{{asset('images/static/VP-copy.webp')}}" alt="Bonnie Avatar">
                        <h3 class="mb-1 text-lg lg:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Alejandra P.singh</a>
                        </h3>
                        <p>VP</p>
                        <p class="my-3 font-semibold text-sm text-gray-500">“Most young people are very much healthier from eating from plant base”</p>
                        <ul class="flex justify-center mt-4 space-x-4">
                            <li>
                                <a href="#" class="text-[#39569c] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-[#00acee] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-900 hover:text-gray-900 dark:hover:text-white dark:text-gray-300">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-[#ea4c89] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" /></svg>
                                </a> 
                            </li> 
                        </ul>
                      
                    </div>
                    <div class="px-2 py-4 bg-white hover:bg-slate-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 group hover:shadow-xl">
                        <img class="mx-auto mb-4  w-48 h-48  rounded-full group-hover:ring-2 group-hover:ring-primary-light transition-all duration-300 ease-in-out group-hover:scale-110" src="{{asset('images/static/Operation-Manager.webp')}}" alt="Operation-Manager">
                        <h3 class="mb-1 text-lg lg:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Phillip Fraser</a>
                        </h3>
                        <p>Operations Manager</p>
                        <p class="my-3 font-semibold text-sm text-gray-500">“Just the way we brew it, with professionalism and love ❤”</p>
                        <ul class="flex justify-center mt-4 space-x-4">
                            <li>
                                <a href="#" class="text-[#39569c] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-[#00acee] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-900 hover:text-gray-900 dark:hover:text-white dark:text-gray-300">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-[#ea4c89] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" /></svg>
                                </a> 
                            </li> 
                        </ul>
                      
                    </div>
             
                </div>  
            </div>
          </section>
    </div>
    <!-- ---- End Category  ----- -->
@endsection
