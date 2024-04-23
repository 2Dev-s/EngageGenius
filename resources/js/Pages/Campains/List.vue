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
                    <InputText placeholder="Search" class="pl-10 w-full dark:bg-gray-800 dark:border-gray-700"
                        v-model="searchQuery" @change="filter()"/>
                </IconField>

                <div class="flex w-full gap-5  items-center flex-wrap ">
                    <InputText class="dark:bg-gray-800 dark:border-gray-700 " v-model="niche" @change="filter()"/>
                    <Dropdown :options="props.templates" optionLabel="name" optionValue="id" @change="filter()" v-model="template"
                        placeholder="Select a Tempalte" class="dark:bg-gray-800 dark:border-gray-700 h-12" filter
                        showClear :pt="{
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
                    <Calendar selectionMode="range" :manualInput="false" class="flex w-fit " :numberOfMonths="2"
                        :showButtonBar="true" v-model="dateTimeFrame" @date-select="filter()"
                        @clear-click="filter()" />

                    <IconField iconPosition="left">
                        <InputIcon>
                            <i class="pi pi-search" />
                        </InputIcon>
                        <InputText placeholder="Product Data" class="pl-10 w-full dark:bg-gray-800 dark:border-gray-700"
                            v-model="productDataSearchQurey" @change="filter()"/>
                    </IconField>

                    <SelectButton :options="endedFilterOptions" v-model="endedFilter" optionLabel="label"
                        optionValue="value" aria-labelledby="basic" class="rounded-md h-12" @change="filter()" />
                    <span>
                        <IconField>
                            <InputIcon>
                                <button @click="campainDiscount = null" v-if="campainDiscount"> X</button>
                            </InputIcon>
                            <InputText v-model.number="campainDiscount" class="w-full" />
                        </IconField>
                        <Slider v-model="campainDiscount" @change="filter()" :pt="{
                            root: ({ props }) => ({
                                class: [
                                    'relative',
                                    // Size
                                    { 'h-1 w-60': props.orientation == 'horizontal', 'w-1 h-56': props.orientation == 'vertical' },
                                    // Shape
                                    'border-0',
                                    // Colors
                                    'bg-surface-100 dark:bg-surface-700',
                                    // States
                                    { 'opacity-60 select-none pointer-events-none cursor-default': props.disabled }
                                ]
                            }),
                            range: ({ props }) => ({
                                class: [
                                    // Position
                                    'block absolute',
                                    {
                                        'top-0 left-0': props.orientation == 'horizontal',
                                        'bottom-0 left-0': props.orientation == 'vertical'
                                    },
                                    //Size
                                    {
                                        'h-full': props.orientation == 'horizontal',
                                        'w-full': props.orientation == 'vertical'
                                    },
                                    // Colors
                                    'bg-primary-500 dark:bg-primary-400'
                                ]
                            }),
                            handle: ({ props }) => ({
                                class: [
                                    'block',
                                    // Size
                                    'h-[1.143rem]',
                                    'w-[1.143rem]',
                                    {
                                        'top-[50%] mt-[-0.5715rem] ml-[-0.5715rem]': props.orientation == 'horizontal',
                                        'left-[50%] mb-[-0.5715rem] ml-[-0.5715rem]': props.orientation == 'vertical'
                                    },
                                    // Shape
                                    'rounded-full',
                                    'border-2',
                                    // Colors
                                    'bg-surface-0 dark:bg-surface-600',
                                    'border-primary-500 dark:border-primary-400',
                                    // States
                                    'hover:bg-primary-500 hover:border-primary-500',
                                    'focus-visible:outline-none focus-visible:outline-offset-0 focus-visible:ring',
                                    'ring-primary-400/50 dark:ring-primary-300/50',
                                    // Transitions
                                    'transition duration-200',
                                    // Misc
                                    'cursor-grab',
                                    'touch-action-none'
                                ]
                            }),
                            starthandler: ({ props }) => ({
                                class: [
                                    'block',
                                    // Size
                                    'h-[1.143rem]',
                                    'w-[1.143rem]',
                                    {
                                        'top-[50%] mt-[-0.5715rem] ml-[-0.5715rem]': props.orientation == 'horizontal',
                                        'left-[50%] mb-[-0.5715rem] ml-[-0.4715rem]': props.orientation == 'vertical'
                                    },
                                    // Shape
                                    'rounded-full',
                                    'border-2',
                                    // Colors
                                    'bg-surface-0 dark:bg-surface-600',
                                    'border-primary-500 dark:border-primary-400',
                                    // States
                                    'hover:bg-primary-500 hover:border-primary-500',
                                    'focus-visible:outline-none focus-visible:outline-offset-0 focus-visible:ring',
                                    'focus-visible:ring-primary-400/50 dark:focus-visible:ring-primary-300/50',
                                    // Transitions
                                    'transition duration-200',
                                    // Misc
                                    'cursor-grab',
                                    'touch-action-none'
                                ]
                            }),
                            endhandler: ({ props }) => ({
                                class: [
                                    'block',
                                    // Size
                                    'h-[1.143rem]',
                                    'w-[1.143rem]',
                                    {
                                        'top-[50%] mt-[-0.5715rem] ml-[-0.5715rem]': props.orientation == 'horizontal',
                                        'left-[50%] mb-[-0.5715rem] ml-[-0.4715rem]': props.orientation == 'vertical'
                                    },
                                    // Shape
                                    'rounded-full',
                                    'border-2',
                                    // Colors
                                    'bg-surface-0 dark:bg-surface-600',
                                    'border-primary-500 dark:border-primary-400',
                                    // States
                                    'hover:bg-primary-500 hover:border-primary-500',
                                    'focus-visible:outline-none focus-visible:outline-offset-0 focus-visible:ring',
                                    'focus-visible:ring-primary-400/50 dark:focus-visible:ring-primary-300/50',
                                    // Transitions
                                    'transition duration-200',
                                    // Misc
                                    'cursor-grab',
                                    'touch-action-none'
                                ]
                            })
                        }" />
                    </span>

                    <IconField iconPosition="left">
                        <InputIcon>
                            <i class="pi pi-sitemap" />
                        </InputIcon>
                        <InputText placeholder="Number of Posts"
                            class="pl-10 w-full dark:bg-gray-800 dark:border-gray-700" type="number"
                            v-model="numberOfPosts" @change="filter()"/>
                    </IconField>
                </div>
            </div>
            <Card class="w-full dark:bg-gray-900 dark:border-gray-700">
                <template #content>
                    <DataView :value="sortedCampains" paginator :rows="10" :pt="{
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
                                        <div
                                            class="bg-black w-full object-fill h-full text-center flex justify-center items-center aspect-video">
                                            <span class="text-2xl">{{ item.title }}</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col w-full flex-1 gap-2 col-span-5 text-white">
                                        <p>{{ item.description }}</p>
                                        <span class="flex gap-4">
                                            <Chip class="flex items-center">
                                                <span
                                                    class="bg-primary-500 dark:bg-primary-400 text-surface-0 dark:text-surface-900 rounded-full h-8 flex items-center justify-center px-4 z-10">Start</span>
                                                <span
                                                    class="font-medium bg-cyan-700 h-8 px-6 flex items-center justify-center rounded-full rounded-s-none -ml-4">{{
                                                        item.start_date }}</span>
                                            </Chip>
                                            <Chip class="flex items-center ">
                                                <span
                                                    class="font-medium bg-cyan-700 h-8 px-6 flex items-center justify-center rounded-full rounded-e-none -mr-4">{{
                                                        item.end_date }}</span>
                                                <span
                                                    class="bg-primary-500 dark:bg-primary-400 text-surface-0 dark:text-surface-900 rounded-full h-8 flex items-center justify-center px-4 z-10">End</span>
                                            </Chip>
                                        </span>
                                        <span class="flex gap-2">
                                            <Tag :value="item.niche" icon="pi pi-tag"
                                                class="text-white dark:bg-blue-700 bg-blue-700"
                                                :pt="{ 'value': 'text-bold text-white ml-2' }" />
                                            <Tag :value="findTemplateName(item.tamplate_id)" icon="pi pi-expand"
                                                class="text-white dark:bg-blue-700 bg-blue-700"
                                                :pt="{ 'value': 'text-bold text-white ml-2' }" />

                                            <Tag :value="item.discount + ' %'" icon="pi pi-dollar"
                                                class="text-white dark:bg-blue-700 bg-blue-700"
                                                :pt="{ 'value': 'text-bold text-white ml-2' }" />
                                        </span>

                                        <span>
                                            <p>{{ item.product_description }}</p>
                                            <p>{{ item.product_features }}</p>
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
import { onMounted, ref } from 'vue'
import UserLayout from '@/Layouts/UserLayout.vue';

import DataView from 'primevue/dataview';
import Card from 'primevue/card';
import Chips from 'primevue/chips';
import Calendar from 'primevue/calendar';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import SpeedDial from 'primevue/speeddial';
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from "primevue/useconfirm";
import Tag from 'primevue/tag';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import SelectButton from 'primevue/selectbutton';
import Slider from 'primevue/slider';

defineOptions({ layout: UserLayout });

const props = defineProps(['campains', "templates"]);
const confirm = useConfirm();
const endedFilterOptions = [
    { label: 'Ended', value: true },
    { label: 'Not Ended', value: false }
];

const searchQuery = ref('');
const niche = ref('');
const dateTimeFrame = ref(null);
const template = ref(null);
const productDataSearchQurey = ref('');
const endedFilter = ref(null);
const numberOfPosts = ref(null);
const campainDiscount = ref(null);

const sortedCampains =  ref([]);

const findTemplate = (id) => {
    return props.templates.find(template => template.id === id);
}

const findTemplateName = (id) => {
    const template = findTemplate(id);
    return template ? template.name : '';
}

const createConfrimDeleteCampain = (campain) => {
    confirm.require({
        header: 'DANGER!Delete Post Confirmation',
        message: 'Do you want to delete this post? Post' + `Campain Title: ${campain.title} Campain (Id): ${campain.id} will be deleted.`,
        rejectClass: 'bg-green-700 p-button-text',
        acceptClass: 'bg-red-700 p-button-text',
        accept: () => {
            window.location = route("campains.delete", campain.id)
        },
        reject: () => { return; }
    });
};

const makeSpeedDialData = (campain) => {
    return [
        { label: 'Delete Campain', icon: 'pi pi-trash', command: () => { createConfrimDeleteCampain(campain) } },
        { label: 'Publish Campain', icon: 'pi pi-send', command: () => { console.log('Publish') } },
        { label: 'Edit Campain', icon: 'pi pi-pencil', command: () => { window.location = route("campains.edit", campain.id) } },
    ];
};

const filter = () => {
    sortedCampains.value = props.campains.filter(campain => {
        let result = true;
        if (searchQuery.value) {
            result = result && campain.title.toLowerCase().includes(searchQuery.value.toLowerCase());
        }
        if (niche.value) {
            result = result && campain.niche === niche.value;
        }
        if (dateTimeFrame.value) {
            result = result && new Date(campain.start_date) >= dateTimeFrame.value[0] && new Date(campain.end_date) <= dateTimeFrame.value[1];
        }
        if (template.value) {
            result = result && campain.tamplate_id === template.value;
        }
        if (productDataSearchQurey.value) {
            result = result && campain.product_description.toLowerCase().includes(productDataSearchQurey.value.toLowerCase()) || campain.product_features.toLowerCase().includes(productDataSearchQurey.value.toLowerCase());
        }
        if (endedFilter.value !== null) {
            result = result && campain.ended === endedFilter.value;
        }
        if (numberOfPosts.value) {
            result = result && campain.number_of_posts === numberOfPosts.value;
        }
        if (campainDiscount.value) {
            result = result && campain.discount === campainDiscount.value;
        }
        return result;
    });
};

onMounted(() => {
    console.log(props.campains);
    filter();
});


</script>