<x-partials.sidebar.option :data="[ 'url' => route('profile'), 'icon' => 'fa-solid fa-user', 'title' => __('Profile')]"/>
<div class="divider"></div>
<x-partials.sidebar.option :data="['url' => route('overall'),'icon' => 'fa-solid fa-circle-info','title' => __('Overall')]"/>
<x-partials.sidebar.option :data="['url' => route('user_list'),'icon' => 'fa-solid fa-users','title' => __('Users')]"/>
<x-partials.sidebar.option :data="['url' => route('post_list'),'icon' => 'fa-solid fa-file','title' => __('Posts')]"/>
<x-partials.sidebar.option :data="['url' => route('access'),'icon' => 'fa-solid fa-lock','title' => __('Access')]"/>
<x-partials.sidebar.option :data="['url' => route('api_keys'),'icon' => 'fa-solid fa-key','title' => __('API Keys')]"/>

