<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Instructor workspace</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Lesson studio</h1>
        </div>
    </x-slot>

    <main class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <section aria-labelledby="lessons-heading" class="space-y-5">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Course materials</p>
                        <h2 id="lessons-heading" class="mt-1 text-xl font-bold text-slate-900">Lesson studio</h2>
                    </div>
                    <span
                        class="rounded-md border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-900">Browser-only
                        drafts</span>
                </div>

                <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm leading-6 text-amber-950">
                    Lesson and video records are not supported by the current database. Drafts below stay in this page
                    session only;
                    nothing is uploaded or saved.
                </div>

                <div class="grid grid-cols-1 gap-5 lg:grid-cols-[minmax(0,1.1fr)_minmax(18rem,0.9fr)]">
                    <div class="space-y-4">
                        <div
                            class="flex flex-col gap-3 rounded-xl border border-slate-200 bg-white p-4 sm:flex-row sm:items-end sm:justify-between">
                            <div class="min-w-0 flex-1">
                                <label for="lesson-course"
                                    class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-600">Course</label>
                                <select id="lesson-course"
                                    class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    @if (!isset($courses) || !is_iterable($courses) || count($courses) === 0) disabled @endif>
                                    @if (isset($courses) && is_iterable($courses) && count($courses))
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    @else
                                        <option value="">No course list supplied</option>
                                    @endif
                                </select>
                            </div>
                            <button id="add-module" type="button"
                                class="rounded-md border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Add
                                section</button>
                        </div>
                        <div id="lesson-modules" class="space-y-4" aria-live="polite"></div>
                    </div>

                    <div class="h-fit space-y-4 rounded-xl border border-slate-200 bg-white p-5">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-indigo-700">Lesson draft</p>
                            <h3 class="mt-1 text-lg font-bold text-slate-900">Add a lesson</h3>
                        </div>
                        <div>
                            <label for="lesson-module"
                                class="mb-1 block text-sm font-medium text-slate-700">Section</label>
                            <select id="lesson-module"
                                class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required></select>
                        </div>
                        <div>
                            <label for="lesson-title" class="mb-1 block text-sm font-medium text-slate-700">Lesson
                                title</label>
                            <input id="lesson-title" type="text" maxlength="160"
                                class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>
                        <div>
                            <label for="lesson-description"
                                class="mb-1 block text-sm font-medium text-slate-700">Description</label>
                            <textarea id="lesson-description" rows="3"
                                class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        <div>
                            <label for="lesson-video-url" class="mb-1 block text-sm font-medium text-slate-700">Video
                                URL</label>
                            <input id="lesson-video-url" type="url" placeholder="https://example.com/video"
                                class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <button id="save-lesson" type="button"
                            class="rounded-md bg-indigo-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-800">Add
                            lesson draft</button>
                        <p id="lesson-status" class="text-xs text-slate-500" role="status">No lesson data is stored by
                            this
                            interface.</p>
                    </div>
                </div>
            </section>

            <script>
                (() => {
                    const modulesElement = document.getElementById('lesson-modules');
                    const moduleSelect = document.getElementById('lesson-module');
                    const titleInput = document.getElementById('lesson-title');
                    const descriptionInput = document.getElementById('lesson-description');
                    const videoInput = document.getElementById('lesson-video-url');
                    const status = document.getElementById('lesson-status');

                    if (!modulesElement || !moduleSelect || !titleInput || !descriptionInput || !videoInput || !status) {
                        return;
                    }

                    const modules = [{
                        id: 1,
                        title: 'Section 1',
                        lessons: []
                    }];
                    let nextModuleId = 2;

                    const render = () => {
                        modulesElement.replaceChildren();
                        moduleSelect.replaceChildren();

                        modules.forEach((module) => {
                            const option = document.createElement('option');
                            option.value = String(module.id);
                            option.textContent = module.title;
                            moduleSelect.append(option);

                            const section = document.createElement('section');
                            section.className = 'overflow-hidden rounded-xl border border-slate-200 bg-white';
                            section.setAttribute('aria-label', module.title);

                            const heading = document.createElement('div');
                            heading.className =
                                'flex items-center justify-between border-b border-slate-100 px-4 py-3';
                            const name = document.createElement('h3');
                            name.className = 'font-semibold text-slate-900';
                            name.textContent = module.title;
                            const count = document.createElement('span');
                            count.className = 'text-xs text-slate-500';
                            count.textContent = `${module.lessons.length} drafts`;
                            heading.append(name, count);

                            const list = document.createElement('ol');
                            list.className = 'divide-y divide-slate-100';
                            if (!module.lessons.length) {
                                const empty = document.createElement('li');
                                empty.className = 'px-4 py-5 text-sm text-slate-500';
                                empty.textContent = 'No lesson drafts in this section.';
                                list.append(empty);
                            }

                            module.lessons.forEach((lesson, index) => {
                                const item = document.createElement('li');
                                item.className =
                                    'flex flex-col gap-3 px-4 py-3 sm:flex-row sm:items-start sm:justify-between';
                                const details = document.createElement('div');
                                details.className = 'min-w-0';
                                const lessonName = document.createElement('p');
                                lessonName.className = 'font-semibold text-slate-900';
                                lessonName.textContent = `${index + 1}. ${lesson.title}`;
                                const description = document.createElement('p');
                                description.className =
                                    'mt-1 whitespace-pre-line text-sm leading-5 text-slate-600';
                                description.textContent = lesson.description || 'No description';
                                details.append(lessonName, description);

                                if (lesson.videoUrl) {
                                    const videoLink = document.createElement('a');
                                    videoLink.className =
                                        'mt-2 inline-block break-all text-sm font-medium text-indigo-700 hover:text-indigo-900';
                                    videoLink.href = lesson.videoUrl;
                                    videoLink.target = '_blank';
                                    videoLink.rel = 'noopener noreferrer';
                                    videoLink.textContent = 'Open video link';
                                    details.append(videoLink);
                                }

                                const remove = document.createElement('button');
                                remove.type = 'button';
                                remove.className =
                                    'shrink-0 rounded-md border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50';
                                remove.textContent = 'Remove draft';
                                remove.addEventListener('click', () => {
                                    module.lessons.splice(index, 1);
                                    render();
                                    status.textContent = 'Draft removed. Changes are not saved.';
                                });

                                item.append(details, remove);
                                list.append(item);
                            });

                            section.append(heading, list);
                            modulesElement.append(section);
                        });
                    };

                    document.getElementById('add-module').addEventListener('click', () => {
                        modules.push({
                            id: nextModuleId,
                            title: `Section ${nextModuleId}`,
                            lessons: []
                        });
                        nextModuleId += 1;
                        render();
                        moduleSelect.value = String(nextModuleId - 1);
                        status.textContent = 'Section added to this page session only.';
                    });

                    document.getElementById('save-lesson').addEventListener('click', () => {
                        const title = titleInput.value.trim();
                        const module = modules.find((item) => String(item.id) === moduleSelect.value);
                        let videoUrl = '';

                        if (!title || !module) {
                            status.textContent = 'Add a lesson title and select a section.';
                            return;
                        }

                        if (videoInput.value.trim()) {
                            try {
                                const parsedUrl = new URL(videoInput.value.trim());
                                if (parsedUrl.protocol !== 'https:' && parsedUrl.protocol !== 'http:') {
                                    throw new Error('Unsupported URL protocol');
                                }
                                videoUrl = parsedUrl.href;
                            } catch {
                                status.textContent = 'Enter a valid http or https video link.';
                                return;
                            }
                        }

                        module.lessons.push({
                            title,
                            description: descriptionInput.value.trim(),
                            videoUrl,
                        });
                        titleInput.value = '';
                        descriptionInput.value = '';
                        videoInput.value = '';
                        render();
                        status.textContent = 'Lesson draft added for this page session only.';
                    });

                    render();
                })();
            </script>
        </div>
    </main>
</x-app-layout>
