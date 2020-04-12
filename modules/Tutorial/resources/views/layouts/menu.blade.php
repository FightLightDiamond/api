<li class="has-sub root-level" id="eLearnMenu">
    <a>
        <i class="fa fa-pencil-square-o"></i>
        <span class="title">{{__('menu.tutorial')}}</span>
    </a>
    <ul>
        <li class="{{ request()->is('tutorial*') ? 'active' : ''}}" id="tutorialMenu">
            <a href="{{route('tutorial.index')}}">
                <span class="title">{{__('table.tutorials')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('tutorial-test*') ? 'active' : ''}}" id="tutorialTestMenu">
            <a href="{{route('tutorial-test.index')}}">
                <span class="title">{{__('table.tutorial_tests')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('tutorial-result*') ? 'active' : ''}}" id="tutorialResultMenu">
            <a href="{{route('tutorial-result.index')}}">
                <span class="title">{{__('table.tutorial_results')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('section*') ? 'active' : ''}}" id="sectionMenu">
            <a href="{{route('section.index')}}">
                <span class="title">{{__('table.sections')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('section-test*') ? 'active' : ''}}" id="sectionTestMenu">
            <a href="{{route('section-test.index')}}">
                <span class="title">{{__('table.section_tests')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('section-result*') ? 'active' : ''}}" id="sectionResultMenu">
            <a href="{{route('section-result.index')}}">
                <span class="title">{{__('table.section_results')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('lesson*') ? 'active' : ''}}" id="lessonMenu">
            <a href="{{route('lesson.index')}}">
                <span class="title">{{__('table.lessons')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('lesson-test*') ? 'active' : ''}}" id="lessonTestMenu">
            <a href="{{route('lesson-test.index')}}">
                <span class="title">{{__('table.lesson_tests')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('lesson-result*') ? 'active' : ''}}" id="lessonResultMenu">
            <a href="{{route('lesson-result.index')}}">
                <span class="title">{{__('table.lesson_results')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('lesson-comment*') ? 'active' : ''}}" id="lessonCommentMenu">
            <a href="{{route('lesson-comment.index')}}">
                <span class="title">{{__('table.lesson_comments')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('lesson-feed-back*') ? 'active' : ''}}" id="lessonFeedBackMenu">
            <a href="{{route('lesson-feed-back.index')}}">
                <span class="title">{{__('table.lesson_feed_backs')}}</span>
            </a>
        </li>
        <li class="{{ request()->is('user-tutorials*') ? 'active' : ''}}" id="userTutorialMenu">
            <a href="{{route('user-tutorials.index')}}">
                <span class="title">{{__('table.user-tutorials')}}</span>
            </a>
        </li>
    </ul>
</li>
