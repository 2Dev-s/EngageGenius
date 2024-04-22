<template>
    <div class="container mx-auto">
        <div class="flex flex-col gap-4 h-full">
            <div class="flex flex-col items-center gap-4 mt-5">
                <IconField iconPosition="left" class="w-full" :pt="{
                    root: ({ props }) => ({
                        class: [
                            'relative',
                            '[&>input]:w-full',
                            '[&>*:first-child]:absolute',
                            '[&>*:first-child]:top-1/2',
                            '[&>*:first-child]:-mt-2',
                            '[&>*:first-child]:leading-none',
                            '[&>*:first-child]:text-surface-900/60 dark:[&>*:first-child]:text-white/60',
                            {
                                '[&>*:first-child]:right-3': props.iconPosition === 'right',
                                '[&>*:first-child]:left-3': props.iconPosition === 'left'
                            },
                            {
                                '[&>*:last-child]:pr-10': props.iconPosition === 'right',
                                '[&>*:last-child]:pl-10': props.iconPosition === 'left'
                            }
                        ]
                    })
                }">
                    <InputIcon>
                        <i class="pi pi-search" />
                    </InputIcon>
                    <InputText placeholder="Search" id="searchQ"
                        class="pl-10 w-full dark:bg-gray-800 dark:border-gray-700" v-model="searchQuery"
                        @change="filter()" />
                </IconField>

                <div class="flex w-full gap-5 align-middle justify-center flex-wrap items-center">

                    <Calendar v-model="publish_date" selectionMode="range" @date-select="filter()"
                        @clear-click="filter()" :manualInput="false" class="flex w-fit " :numberOfMonths="2"
                        :showButtonBar="true" />

                    <Dropdown :options="props.campains" @change="filter()" optionLabel="title" optionValue="id"
                        v-model="campain" placeholder="Select a Campain"
                        class="dark:bg-gray-800 dark:border-gray-700 h-12" filter showClear :pt="{
                            root: ({ props, state }) => ({
                                class: [
                                    // Display and Position
                                    'inline-flex',
                                    'relative',
                                    // Shape
                                    'rounded-md',
                                    // Color and Background
                                    'bg-surface-0 dark:bg-surface-900',
                                    'border',
                                    { 'border-surface-300 dark:border-surface-600': !props.invalid },
                                    // Invalid State
                                    { 'border-red-500 dark:border-red-400': props.invalid },
                                    // Transitions
                                    'transition-all',
                                    'duration-200',
                                    // States
                                    { 'hover:border-primary-500 dark:hover:border-primary-300': !props.invalid },
                                    { 'outline-none outline-offset-0 ring ring-primary-400/50 dark:ring-primary-300/50': state.focused },
                                    // Misc
                                    'cursor-pointer',
                                    'select-none',
                                    { 'opacity-60': props.disabled, 'pointer-events-none': props.disabled, 'cursor-default': props.disabled }
                                ]
                            }),
                            input: ({ props }) => ({
                                class: [
                                    //Font
                                    'font-sans',
                                    'leading-none',
                                    // Display
                                    'block',
                                    'flex-auto',
                                    // Color and Background
                                    'bg-transparent',
                                    'border-0',
                                    { 'text-surface-800 dark:text-white/80': props.modelValue != null, 'text-surface-400 dark:text-surface-500': props.modelValue == null },
                                    'placeholder:text-surface-400 dark:placeholder:text-surface-500',
                                    // Sizing and Spacing
                                    'w-[1%]',
                                    'p-3',
                                    { 'pr-7': props.showClear },
                                    //Shape
                                    'rounded-none',
                                    // Transitions
                                    'transition',
                                    'duration-200',

                                    // States
                                    'focus:outline-none focus:shadow-none',
                                    // Misc
                                    'relative',
                                    'cursor-pointer',
                                    'overflow-hidden overflow-ellipsis',
                                    'whitespace-nowrap',
                                    'appearance-none'
                                ]
                            }),
                            trigger: {
                                class: ['flex items-center justify-center', 'shrink-0', 'bg-transparent', 'text-surface-500', 'w-12', 'rounded-tr-md', 'rounded-br-md']
                            },
                            panel: {
                                class: ['absolute top-0 left-0', 'border-0 dark:border', 'rounded-md', 'shadow-md', 'bg-surface-0 dark:bg-surface-800', 'text-surface-800 dark:text-white/80', 'dark:border-surface-700']
                            },
                            wrapper: {
                                class: ['max-h-[200px]', 'overflow-auto']
                            },
                            list: {
                                class: 'py-3 list-none m-0'
                            },
                            item: ({ context }) => ({
                                class: [
                                    // Font
                                    'font-normal',
                                    'leading-none',
                                    // Position
                                    'relative',
                                    // Shape
                                    'border-0',
                                    'rounded-none',
                                    // Spacing
                                    'm-0',
                                    'py-3 px-5',
                                    // Color
                                    { 'text-surface-700 dark:text-white/80': !context.focused && !context.selected && !context.disabled },
                                    { 'text-surface-600 dark:text-white/70': !context.focused && !context.selected && context.disabled },
                                    { 'bg-surface-200 dark:bg-surface-600/60 text-surface-700 dark:text-white/80': context.focused && !context.selected },
                                    { 'bg-primary-100 dark:bg-primary-400/40 text-primary-700 dark:text-white/80': context.focused && context.selected },
                                    { 'bg-primary-50 dark:bg-primary-400/40 text-primary-700 dark:text-white/80': !context.focused && context.selected },
                                    //States
                                    { 'hover:bg-surface-100 dark:hover:bg-surface-600/80': !context.focused && !context.selected },
                                    { 'hover:text-surface-700 hover:bg-surface-100 dark:hover:text-white dark:hover:bg-surface-600/80': context.focused && !context.selected },
                                    'focus-visible:outline-none focus-visible:outline-offset-0 focus-visible:ring focus-visible:ring-inset focus-visible:ring-primary-400/50 dark:focus-visible:ring-primary-300/50',
                                    // Transitions
                                    'transition-shadow',
                                    'duration-200',
                                    // Misc
                                    { 'pointer-events-none cursor-default': context.disabled },
                                    { 'cursor-pointer': !context.disabled },
                                    'overflow-hidden',
                                    'whitespace-nowrap'
                                ]
                            }),
                            itemgroup: {
                                class: ['font-bold', 'm-0', 'py-3 px-5', 'text-surface-800 dark:text-white/80', 'bg-surface-0 dark:bg-surface-600/80', 'cursor-auto']
                            },
                            emptymessage: {
                                class: ['leading-none', 'py-3 px-5', 'text-surface-800 dark:text-white/80', 'bg-transparent']
                            },
                            header: {
                                class: ['py-3 px-5', 'm-0', 'border-b', 'rounded-tl-md', 'rounded-tr-md', 'text-surface-700 dark:text-white/80', 'bg-surface-100 dark:bg-surface-800', 'border-surface-300 dark:border-surface-700']
                            },
                            filtercontainer: {
                                class: 'relative'
                            },
                            filterinput: {
                                class: ['font-sans', 'leading-none', 'pr-7 py-3 px-3', '-mr-7', 'w-full', 'text-surface-700 dark:text-white/80', 'bg-surface-0 dark:bg-surface-900', 'border-surface-200 dark:border-surface-700', 'border', 'rounded-lg', 'appearance-none', 'transition', 'duration-200', 'hover:border-primary-500 dark:hover:border-primary-300', 'focus:ring focus:outline-none focus:outline-offset-0', 'focus:ring-primary-400/50 dark:focus:ring-primary-300/50', 'appearance-none']
                            },
                            filtericon: {
                                class: ['absolute', 'top-1/2 right-3', '-mt-2']
                            },
                            clearicon: {
                                class: ['text-surface-500', 'absolute', 'top-1/2', 'right-12', '-mt-2']
                            },
                            transition: {
                                enterFromClass: 'opacity-0 scale-y-[0.8]',
                                enterActiveClass: 'transition-[transform,opacity] duration-[120ms] ease-[cubic-bezier(0,0,0.2,1)]',
                                leaveActiveClass: 'transition-opacity duration-100 ease-linear',
                                leaveToClass: 'opacity-0'
                            }
                        }" />

                    <MultiSelect placeholder="Select Socials" @change="filter()" :options="props.socials"
                        v-model="socials" display="chip" class="dark:bg-gray-800 dark:border-gray-700 h-12" :pt="{
                            panel: 'dark:bg-gray-800 dark:border-gray-700 text-white',
                            wrapper: 'overflow-y-auto',
                            token: {
                                class: ['inline-flex items-center', 'py-1.5 px-3 mr-2', 'rounded-[1.14rem]', 'bg-surface-200 dark:bg-surface-700', 'text-surface-700 dark:text-white/70', 'cursor-default']
                            },
                        }" />

                    <SelectButton v-model="publish_state" :options="publishFilterOptions" optionLabel="label"
                        optionValue="value" aria-labelledby="basic" class="rounded-md h-12" @change="filter()" />

                    <Chips v-model="tags" class="dark:bg-gray-800 dark:border-gray-700 " :pt="{
                        token: {
                            class: ['inline-flex items-center', 'py-1.5 px-3', 'rounded-[1.14rem]', 'text-surface-700 dark:text-white/70', 'bg-surface-200 dark:bg-surface-700']
                        },
                        input: {
                            class: ['font-sans text-base leading-[1.2]', 'w-full', 'p-0 m-0', 'appearance-none rounded-none', 'border-0 outline-none', 'shadow-none', 'text-surface-700 dark:text-white/80', 'bg-transparent']
                        },
                        container: ({ state, props }) => ({
                            class: [
                                // Font
                                'font-sans text-base leading-none',
                                // Flex
                                'flex items-center flex-wrap gap-2',
                                // Spacing
                                'm-0 py-1.5 px-3',
                                // Size
                                'w-full',
                                'min-h-[2.877rem]',
                                // Shape
                                'list-none',
                                'rounded-md',
                                // Color
                                'text-surface-700 dark:text-white/80',
                                'bg-surface-0 dark:bg-surface-900',
                                'border',
                                { 'border-surface-300 dark:border-surface-600': !props.invalid },
                                // Invalid State
                                { 'border-red-500 dark:border-red-400': props.invalid },
                                // States
                                { 'hover:border-primary-500 dark:hover:border-primary-400': !props.invalid },
                                'focus:outline-none focus:outline-offset-0',
                                { 'ring ring-primary-400/50 dark:ring-primary-300/50': state.focused },
                                { 'ring ring-primary-400/50 dark:ring-primary-300/50': state.hovered },
                                // Transition
                                'transition-colors duration-200',
                                // Misc
                                'cursor-text overflow-hidden',
                                'appearance-none'
                            ]
                        })
                    }" @add="filter()" @remove="filter()" />
                </div>
            </div>

            <Card class="w-full dark:bg-gray-900 dark:border-gray-700">
                <template #content>
                    <DataView :value="filteredArray" paginator :rows="10" :pt="{
                        paginator: {
                            root: {
                                class: ['flex items-center justify-center flex-wrap', 'px-4 py-2', 'border-0', 'bg-surface-0 dark:bg-surface-800', 'text-surface-500 dark:text-white/60']
                            },
                            firstpagebutton: ({ context }) => ({
                                class: [
                                    'relative',
                                    // Flex & Alignment
                                    'inline-flex items-center justify-center',
                                    // Shape
                                    'border-0 rounded-full dark:rounded-md',
                                    // Size
                                    'min-w-[3rem] h-12 m-[0.143rem]',
                                    'leading-none',
                                    // Color
                                    'text-surface-500 dark:text-white/60',
                                    // State
                                    {
                                        'hover:bg-surface-50 dark:hover:bg-surface-700/70': !context.disabled,
                                        'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-400/50 dark:focus:ring-primary-300/50': !context.disabled
                                    },
                                    // Transition
                                    'transition duration-200',
                                    // Misc
                                    'user-none overflow-hidden',
                                    { 'cursor-default pointer-events-none opacity-60': context.disabled }
                                ]
                            }),
                            previouspagebutton: ({ context }) => ({
                                class: [
                                    'relative',
                                    // Flex & Alignment
                                    'inline-flex items-center justify-center',
                                    // Shape
                                    'border-0 rounded-full dark:rounded-md',
                                    // Size
                                    'min-w-[3rem] h-12 m-[0.143rem]',
                                    'leading-none',
                                    // Color
                                    'text-surface-500 dark:text-white/60',
                                    // State
                                    {
                                        'hover:bg-surface-50 dark:hover:bg-surface-700/70': !context.disabled,
                                        'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-400/50 dark:focus:ring-primary-300/50': !context.disabled
                                    },
                                    // Transition
                                    'transition duration-200',
                                    // Misc
                                    'user-none overflow-hidden',
                                    { 'cursor-default pointer-events-none opacity-60': context.disabled }
                                ]
                            }),
                            nextpagebutton: ({ context }) => ({
                                class: [
                                    'relative',
                                    // Flex & Alignment
                                    'inline-flex items-center justify-center',
                                    // Shape
                                    'border-0 rounded-full dark:rounded-md',
                                    // Size
                                    'min-w-[3rem] h-12 m-[0.143rem]',
                                    'leading-none',
                                    // Color
                                    'text-surface-500 dark:text-white/60',
                                    // State
                                    {
                                        'hover:bg-surface-50 dark:hover:bg-surface-700/70': !context.disabled,
                                        'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-400/50 dark:focus:ring-primary-300/50': !context.disabled
                                    },
                                    // Transition
                                    'transition duration-200',
                                    // Misc
                                    'user-none overflow-hidden',
                                    { 'cursor-default pointer-events-none opacity-60': context.disabled }
                                ]
                            }),
                            lastpagebutton: ({ context }) => ({
                                class: [
                                    'relative',
                                    // Flex & Alignment
                                    'inline-flex items-center justify-center',
                                    // Shape
                                    'border-0 rounded-full dark:rounded-md',
                                    // Size
                                    'min-w-[3rem] h-12 m-[0.143rem]',
                                    'leading-none',
                                    // Color
                                    'text-surface-500 dark:text-white/60',
                                    // State
                                    {
                                        'hover:bg-surface-50 dark:hover:bg-surface-700/70': !context.disabled,
                                        'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-400/50 dark:focus:ring-primary-300/50': !context.disabled
                                    },
                                    // Transition
                                    'transition duration-200',
                                    // Misc
                                    'user-none overflow-hidden',
                                    { 'cursor-default pointer-events-none opacity-60': context.disabled }
                                ]
                            }),
                            pagebutton: ({ context }) => ({
                                class: [
                                    'relative',
                                    // Flex & Alignment
                                    'inline-flex items-center justify-center',
                                    // Shape
                                    'border-0 rounded-full dark:rounded-md',
                                    // Size
                                    'min-w-[3rem] h-12 m-[0.143rem]',
                                    'leading-none',
                                    // Color
                                    'text-surface-500 dark:text-white/80',
                                    {
                                        'bg-primary-50 border-primary-50 dark:border-transparent text-primary-700 dark:text-surface-0 dark:bg-primary-400/30': context.active
                                    },
                                    // State
                                    {
                                        'hover:bg-surface-50 dark:hover:bg-surface-700/70': !context.disabled && !context.active,
                                        'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-400/50 dark:focus:ring-primary-300/50': !context.disabled
                                    },
                                    // Transition
                                    'transition duration-200',
                                    // Misc
                                    'user-none overflow-hidden',
                                    { 'cursor-default pointer-events-none opacity-60': context.disabled }
                                ]
                            }),
                            rowperpagedropdown: {
                                root: ({ props, state }) => ({
                                    class: [
                                        // Display and Position
                                        'inline-flex',
                                        'relative',
                                        // Shape
                                        'h-12',
                                        'rounded-md',
                                        // Spacing
                                        'mx-2',
                                        // Color and Background
                                        'bg-surface-0 dark:bg-surface-900',
                                        'border border-surface-300 dark:border-surface-700',
                                        // Transitions
                                        'transition-all',
                                        'duration-200',
                                        // States
                                        'hover:border-primary-500 dark:hover:border-primary-300',
                                        { 'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-400/50 dark:focus:ring-primary-300/50': !state.focused },
                                        // Misc
                                        'cursor-pointer',
                                        'select-none',
                                        { 'opacity-60': props.disabled, 'pointer-events-none': props.disabled, 'cursor-default': props.disabled }
                                    ]
                                }),
                                input: {
                                    class: ['font-sans', 'leading-5', 'block', 'flex-auto', 'bg-transparent', 'border-0', 'text-surface-800 dark:text-white/80', 'w-[1%]', 'p-3 pr-0', 'rounded-none', 'transition', 'duration-200', 'focus:outline-none focus:shadow-none', 'relative', 'cursor-pointer', 'overflow-hidden overflow-ellipsis', 'whitespace-nowrap', 'appearance-none']
                                },
                                trigger: {
                                    class: ['flex items-center justify-center', 'shrink-0', 'bg-transparent', 'text-surface-500', 'w-12', 'rounded-tr-md', 'rounded-br-md']
                                },
                                panel: {
                                    class: ['absolute top-0 left-0', 'border-0 dark:border', 'rounded-md', 'shadow-md', 'bg-surface-0 dark:bg-surface-800', 'text-surface-800 dark:text-white/80', 'dark:border-surface-700']
                                },
                                wrapper: {
                                    class: ['max-h-[200px]', 'overflow-auto']
                                },
                                list: {
                                    class: 'py-3 list-none m-0'
                                },
                                item: ({ context }) => ({
                                    class: [
                                        // Font
                                        'font-normal',
                                        'leading-none',
                                        // Position
                                        'relative',
                                        // Shape
                                        'border-0',
                                        'rounded-none',
                                        // Spacing
                                        'm-0',
                                        'py-3 px-5',
                                        // Color
                                        { 'text-surface-700 dark:text-white/80': !context.focused && !context.selected },
                                        { 'bg-surface-50 dark:bg-surface-600/60 text-surface-700 dark:text-white/80': context.focused && !context.selected },
                                        { 'bg-primary-100 dark:bg-primary-400/40 text-primary-700 dark:text-white/80': context.focused && context.selected },
                                        { 'bg-primary-50 dark:bg-primary-400/40 text-primary-700 dark:text-white/80': !context.focused && context.selected },
                                        //States
                                        { 'hover:bg-surface-100 dark:hover:bg-surface-600/80': !context.focused && !context.selected },
                                        { 'hover:text-surface-700 hover:bg-surface-100 dark:hover:text-white dark:hover:bg-surface-600/80': context.focused && !context.selected },
                                        // Transitions
                                        'transition-shadow',
                                        'duration-200',
                                        // Misc
                                        'cursor-pointer',
                                        'overflow-hidden',
                                        'whitespace-nowrap'
                                    ]
                                })
                            },
                            jumptopageinput: {
                                root: {
                                    class: 'inline-flex mx-2'
                                },
                                input: {
                                    root: {
                                        class: ['relative', 'font-sans', 'leading-none', 'block', 'flex-auto', 'text-surface-600 dark:text-surface-200', 'placeholder:text-surface-400 dark:placeholder:text-surface-500', 'bg-surface-0 dark:bg-surface-900', 'border border-surface-300 dark:border-surface-600', 'w-[1%] max-w-[3rem]', 'p-3 m-0', 'rounded-md', 'transition', 'duration-200', 'hover:border-primary-500 dark:hover:border-primary-400', 'focus:outline-none focus:shadow-none', 'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-500/50 dark:focus:ring-primary-400/50', 'cursor-pointer', 'overflow-hidden overflow-ellipsis', 'whitespace-nowrap', 'appearance-none']
                                    }
                                }
                            },
                            jumptopagedropdown: {
                                root: ({ props, state }) => ({
                                    class: [
                                        // Display and Position
                                        'inline-flex',
                                        'relative',
                                        // Shape
                                        'h-12',
                                        'rounded-md',
                                        // Color and Background
                                        'bg-surface-0 dark:bg-surface-900',
                                        'border border-surface-300 dark:border-surface-700',
                                        // Transitions
                                        'transition-all',
                                        'duration-200',
                                        // States
                                        'hover:border-primary-500 dark:hover:border-primary-300',
                                        { 'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-400/50 dark:focus:ring-primary-300/50': !state.focused },
                                        // Misc
                                        'cursor-pointer',
                                        'select-none',
                                        { 'opacity-60': props.disabled, 'pointer-events-none': props.disabled, 'cursor-default': props.disabled }
                                    ]
                                }),
                                input: {
                                    class: ['font-sans', 'leading-none', 'block', 'flex-auto', 'bg-transparent', 'border-0', 'text-surface-800 dark:text-white/80', 'w-[1%]', 'p-3', 'rounded-none', 'transition', 'duration-200', 'focus:outline-none focus:shadow-none', 'relative', 'cursor-pointer', 'overflow-hidden overflow-ellipsis', 'whitespace-nowrap', 'appearance-none']
                                },
                                trigger: {
                                    class: ['flex items-center justify-center', 'shrink-0', 'bg-transparent', 'text-surface-500', 'w-12', 'rounded-tr-md', 'rounded-br-md']
                                },
                                panel: {
                                    class: ['absolute top-0 left-0', 'border-0 dark:border', 'rounded-md', 'shadow-md', 'bg-surface-0 dark:bg-surface-800', 'text-surface-800 dark:text-white/80', 'dark:border-surface-700']
                                },
                                wrapper: {
                                    class: ['max-h-[200px]', 'overflow-auto']
                                },
                                list: {
                                    class: 'py-3 list-none m-0'
                                },
                                item: ({ context }) => ({
                                    class: [
                                        // Font
                                        'font-normal',
                                        'leading-none',
                                        // Position
                                        'relative',
                                        // Shape
                                        'border-0',
                                        'rounded-none',
                                        // Spacing
                                        'm-0',
                                        'py-3 px-5',
                                        // Color
                                        { 'text-surface-700 dark:text-white/80': !context.focused && !context.selected },
                                        { 'bg-surface-50 dark:bg-surface-600/60 text-surface-700 dark:text-white/80': context.focused && !context.selected },
                                        { 'bg-primary-100 dark:bg-primary-400/40 text-primary-700 dark:text-white/80': context.focused && context.selected },
                                        { 'bg-primary-50 dark:bg-primary-400/40 text-primary-700 dark:text-white/80': !context.focused && context.selected },
                                        //States
                                        { 'hover:bg-surface-100 dark:hover:bg-surface-600/80': !context.focused && !context.selected },
                                        { 'hover:text-surface-700 hover:bg-surface-100 dark:hover:text-white dark:hover:bg-surface-600/80': context.focused && !context.selected },
                                        // Transitions
                                        'transition-shadow',
                                        'duration-200',
                                        // Misc
                                        'cursor-pointer',
                                        'overflow-hidden',
                                        'whitespace-nowrap'
                                    ]
                                })
                            },
                            start: {
                                class: 'mr-auto'
                            },
                            end: {
                                class: 'ml-auto'
                            }
                        }
                    }">
                        <template #list="slotProps">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <div v-for="(item, index) in slotProps.items" :key="index"
                                    class="w-full p-3 grid grid-cols-8 border rounded-lg dark:bg-gray-800 dark:border-gray-800 bg-opacity-5 shadow-md gap-4">

                                    <div
                                        class="rounded-lg overflow-hidden w-full h-full  col-span-2 flex flex-col items-center align-middle">
                                        <img alt="" :src="determineTumnail(item)" class="w-full object-fill" width="300"
                                            height="200">
                                        <!--                                              <div class="bg-black w-full object-fill h-full text-center flex justify-center items-center aspect-video" v-else>
                                                <span class="text-2xl">EngageGenius</span>
                                             </div>    -->
                                    </div>

                                    <div class="flex flex-col w-full flex-1 gap-2 col-span-5 text-white">
                                        <p>{{ item.title }}</p>
                                        <p class="w-2/3">{{ item.description.slice(0, 300) + " ..." }}</p>
                                        <span class="flex gap-2">
                                            <Chip class="flex">
                                                <span
                                                    class="text-surface-0  rounded-full w-fit px-2 flex items-center justify-center bg-slate-600 z-10 text-white">Publish
                                                    Date</span>
                                                <span
                                                    class="text-surface-0  rounded-full rounded-s-none h-8 flex items-center justify-center w-fit bg-blue-700 px-5 -ml-4">{{
                                                        item.publish_date }}</span>
                                            </Chip>
                                            <Chip class="flex">
                                                <span :class="{
                                                    'bg-green-600': item.publish_state,
                                                    'bg-red-600': !item.publish_state
                                                }"
                                                    class="text-surface-0 rounded-full w-8 h-8 flex items-center justify-center z-10 ">
                                                    <icon>
                                                        <i class="pi pi-check" v-if="item.publish_state"></i>
                                                        <i class="pi pi-times" v-else></i>
                                                    </icon>
                                                </span>
                                                <span
                                                    class="font-medium bg-slate-600 px-5 flex items-center rounded-full rounded-s-none justify-center -ml-3  text-white">Published</span>
                                            </Chip>
                                        </span>

                                        <Chip class="flex">
                                            <span
                                                class="rounded-full w-fit px-2 flex items-center justify-center bg-slate-600 z-10 text-white">Campain</span>
                                            <span
                                                class="rounded-s-none rounded-full w-fit px-4 flex items-center justify-center bg-orange-700 -ml-2 text-black">{{
                                                    getCampainName(item.campain_id) }}</span>
                                        </Chip>

                                        <span class="flex gap-2 flex-wrap">
                                            <Tag value="Twitter" icon="pi pi-twitter" v-if="item.post_to_twitter"
                                                class="text-white dark:bg-blue-700 bg-blue-700"
                                                :pt="{ 'value': 'text-bold text-white ml-2' }" />

                                            <Tag value="Pinterest" icon="pi pi-pinterest" v-if="item.post_to_pinterest"
                                                class="dark:bg-red-900 text-white"
                                                :pt="{ 'value': 'text-bold text-white ml-2' }" />

                                            <Tag value="Facebook" icon="pi pi-facebook" v-if="item.post_to_facebook"
                                                class="bg-blue-600  dark:bg-blue-700 text-white"
                                                :pt="{ 'value': 'text-bold ml-2' }" />

                                            <Tag value="Instagram" icon="pi pi-instagram" v-if="item.post_to_instagram"
                                                class="dark:bg-gradient-to-br dark:from-pink-500  dark:via-red-500 dark:to-yellow-500 text-white"
                                                :pt="{ 'value': 'text-bold ml-2' }" />

                                            <Tag value="LinkedIn" icon="pi pi-linkedin"
                                                class="dark:bg-blue-500 text-black" v-if="item.post_to_linkedin"
                                                :pt="{ 'value': 'font-bold ml-2' }" />
                                        </span>
                                    </div>
                                    <div class="flex items-center col-span-1">
                                        <SpeedDial :model="makeSpeedDialData(item)" :radius="75" type="semi-circle"
                                            :tooltipOptions="{ position: 'right' }" showIcon="pi pi-bars"
                                            buttonClass="dark:bg-blue-700 border-0 text-white" direction="right" :pt="{
                                                menuitem: ({ props, context }) => ({
                                                    class: [
                                                        'transform transition-transform duration-200 ease-out transition-opacity duration-800 bg-blue-800 text-white rounded-full',
                                                        // Conditional Appearance
                                                        context.hidden ? 'opacity-0 scale-0' : 'opacity-100 scale-100',
                                                        // Conditional Spacing
                                                        {
                                                            'my-1 first:mb-2': props.direction == 'up' && props.type == 'linear',
                                                            'my-1 first:mt-2': props.direction == 'down' && props.type == 'linear',
                                                            'mx-1 first:mr-2': props.direction == 'left' && props.type == 'linear',
                                                            'mx-1 first:ml-2': props.direction == 'right' && props.type == 'linear'
                                                        },
                                                        // Conditional Positioning
                                                        { absolute: props.type !== 'linear' }
                                                    ]
                                                }),
                                            }" />

                                    </div>
                                </div>
                            </div>
                        </template>
                    </DataView>
                </template>
            </Card>
        </div>
    </div>

    <ConfirmDialog class="bg-gray-900 text-white " :pt="{
        root: ({ state }) => ({
            class: [
                // Shape
                'rounded-lg',
                'shadow-lg',
                'border-0',
                // Size
                'max-h-[90vh]',
                'w-[50vw]',
                'm-0',
                // Color
                'dark:border',
                'dark:border-surface-700',
                // Transitions
                'transform',
                'scale-100',
                // Maximized State
                {
                    'transition-none': state.maximized,
                    'transform-none': state.maximized,
                    '!w-screen': state.maximized,
                    '!h-screen': state.maximized,
                    '!max-h-full': state.maximized,
                    '!top-0': state.maximized,
                    '!left-0': state.maximized
                }
            ]
        }),
        header: {
            class: ['flex items-center justify-between', 'shrink-0', 'p-6', 'border-t-0', 'rounded-tl-lg', 'rounded-tr-lg', 'bg-surface-0 dark:bg-surface-800', 'text-surface-700 dark:text-surface-0/80']
        },
        title: {
            class: ['font-bold text-lg']
        },
        icons: {
            class: ['flex items-center']
        },
        closeButton: {
            class: ['relative', 'flex items-center justify-center', 'mr-2', 'last:mr-0', 'w-8 h-8', 'border-0', 'rounded-full', 'text-surface-500', 'bg-transparent', 'transition duration-200 ease-in-out', 'hover:text-surface-700 dark:hover:text-white/80', 'hover:bg-surface-100 dark:hover:bg-surface-800/80', 'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-inset', 'focus:ring-primary-400/50 dark:focus:ring-primary-300/50', 'overflow-hidden']
        },
        maximizablebutton: {
            class: ['relative', 'flex items-center justify-center', 'mr-2', 'last:mr-0', 'w-8 h-8', 'border-0', 'rounded-full', 'text-surface-500', 'bg-transparent', 'transition duration-200 ease-in-out', 'hover:text-surface-700 dark:hover:text-white/80', 'hover:bg-surface-100 dark:hover:bg-surface-800/80', 'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-inset', 'focus:ring-primary-400/50 dark:focus:ring-primary-300/50', 'overflow-hidden']
        },
        closeButtonIcon: {
            class: ['inline-block', 'w-4', 'h-4']
        },
        maximizableicon: {
            class: ['inline-block', 'w-4', 'h-4']
        },
        content: ({ state, instance }) => ({
            class: [
                // Spacing
                'px-6',
                'pb-8',
                'pt-0',
                // Shape
                {
                    grow: state.maximized,
                    'rounded-bl-lg': !instance.$slots.footer,
                    'rounded-br-lg': !instance.$slots.footer
                },
                // Colors
                'bg-surface-0 dark:bg-surface-800',
                'text-surface-700 dark:text-surface-0/80',
                // Misc
                'overflow-y-auto'
            ]
        }),
        footer: {
            class: ['flex items-center justify-end', 'shrink-0', 'text-right', 'gap-2', 'px-6', 'pb-6', 'border-t-0', 'rounded-b-lg', 'bg-surface-0 dark:bg-surface-800', 'text-surface-700 dark:text-surface-0/80']
        },
        mask: ({ props }) => ({
            class: [
                // Transitions
                'transition-all',
                'duration-300',
                { 'p-5': !props.position == 'full' },
                // Background and Effects
                { 'has-[.mask-active]:bg-transparent bg-black/40': props.modal, 'has-[.mask-active]:backdrop-blur-none backdrop-blur-sm': props.modal }
            ]
        }),
        transition: ({ props }) => props.position === 'top' ? {
            enterFromClass: 'opacity-0 scale-75 translate-x-0 -translate-y-full translate-z-0 mask-active',
            enterActiveClass: 'transition-all duration-200 ease-out',
            leaveActiveClass: 'transition-all duration-200 ease-out',
            leaveToClass: 'opacity-0 scale-75 translate-x-0 -translate-y-full translate-z-0 mask-active'
        } : props.position === 'bottom' ? {
            enterFromClass: 'opacity-0 scale-75 translate-y-full mask-active',
            enterActiveClass: 'transition-all duration-200 ease-out',
            leaveActiveClass: 'transition-all duration-200 ease-out',
            leaveToClass: 'opacity-0 scale-75 translate-x-0 translate-y-full translate-z-0 mask-active'
        } : props.position === 'left' || props.position === 'topleft' || props.position === 'bottomleft' ? {
            enterFromClass: 'opacity-0 scale-75 -translate-x-full translate-y-0 translate-z-0 mask-active',
            enterActiveClass: 'transition-all duration-200 ease-out',
            leaveActiveClass: 'transition-all duration-200 ease-out',
            leaveToClass: 'opacity-0 scale-75  -translate-x-full translate-y-0 translate-z-0 mask-active'
        } : props.position === 'right' || props.position === 'topright' || props.position === 'bottomright' ? {
            enterFromClass: 'opacity-0 scale-75 translate-x-full translate-y-0 translate-z-0 mask-active',
            enterActiveClass: 'transition-all duration-200 ease-out',
            leaveActiveClass: 'transition-all duration-200 ease-out',
            leaveToClass: 'opacity-0 scale-75 translate-x-full translate-y-0 translate-z-0 mask-active'
        } : {
            enterFromClass: 'opacity-0 scale-75 mask-active',
            enterActiveClass: 'transition-all duration-200 ease-out',
            leaveActiveClass: 'transition-all duration-200 ease-out',
            leaveToClass: 'opacity-0 scale-75 mask-active'
        }
    }">
    </ConfirmDialog>

</template>


<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import { onMounted, ref } from 'vue'

import DataView from 'primevue/dataview';
import Card from 'primevue/card';
import Chips from 'primevue/chips';
import Calendar from 'primevue/calendar';
import MultiSelect from 'primevue/multiselect';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import SpeedDial from 'primevue/speeddial';
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from "primevue/useconfirm";
import Tag from 'primevue/tag';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import SelectButton from 'primevue/selectbutton';

defineOptions({ layout: UserLayout })

const props = defineProps(['posts', 'campains', 'socials']);
const confirm = useConfirm();

const publishFilterOptions = [
    { label: 'Published', value: true },
    { label: 'Not Published', value: false }
];

const searchQuery = ref('');
const publish_date = ref(null);
const campain = ref(null);
const publish_state = ref(null);
const socials = ref([]);
const tags = ref([]);

const filteredArray = ref([]);

const filter = () => {
    filteredArray.value = props.posts.filter(post => {

        let search = true;
        let date = true;
        let campainID = true;
        let ifPublish = true;
        let socialsState = true;
        let hasTags = true;

        if (searchQuery.value) {
            search = post.title.toLowerCase().includes(searchQuery.value.toLowerCase()) || post.description.toLowerCase().includes(searchQuery.value.toLowerCase());
        }

        if (publish_state.value != null) {
            ifPublish = post.published == publish_state.value;
        }

        if (campain.value != null) {
            ;
            campainID = post.campain_id == campain.value;
        }

        if (socials.value.length > 0) {
            socialsState = socials.value.every(social => post[social] == 1);
        }

        if (publish_date.value != null) {

            const dateFrom = new Date(publish_date.value[0]);

            const dateCheck = new Date(post.publish_date);

            date = dateCheck >= dateFrom;

            if (publish_date.value[1]) {
                date = dateCheck >= dateFrom && dateCheck <= new Date(publish_date.value[1]);
            }
        }

        if (tags.value.length > 0) {
            hasTags = tags.value.every(tag => post.tags.includes(tag));
        }

        return search && ifPublish && campainID && socialsState && date && hasTags;
    });
}

onMounted(() => {
    filter();
});

const createConfrimDeletePost = (post) => {
    confirm.require({
        header: 'DANGER!Delete Post Confirmation',
        message: 'Do you want to delete this post? Post' + `Post Title: ${post.title} Post (Id): ${post.id} will be deleted.`,
        rejectClass: 'bg-green-700 p-button-text',
        acceptClass: 'bg-red-700 p-button-text',
        accept: () => {
            window.location = route("posts.delete", post.id)
        },
        reject: () => { return; }
    });
};

const makeSpeedDialData = (post) => {
    return [
        { label: 'Delete Post', icon: 'pi pi-trash', command: () => { createConfrimDeletePost(post) } },
        { label: 'Publish Post', icon: 'pi pi-send', command: () => { console.log('Publish') } },
        { label: 'Edit Post', icon: 'pi pi-pencil', command: () => { window.location = route("posts.edit", post.id) } },
    ];
}

const getCampainName = (id) => {
    if (id != null) {
        let campainTitle = props.campains.find(campain => campain.id === id).title;
        if (campainTitle) {
            return campainTitle;
        }
    }


    return "No Campain";
}

const determineTumnail = (post) => {
    if (post.thumbnail_path) {
        return '/storage' + post.thumbnail_path;
    }
    return "https://via.placeholder.com/600x400";
}
</script>
