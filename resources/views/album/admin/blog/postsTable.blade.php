@if(isset($posts) && count($posts) > 0)
    <table class="table table-bordered justify-content-center">
        <thead>
        <tr>
            <th scope="col" style="color: #ffffff">Название</th>
            <th scope="col" style="color: #ffffff">Обложка</th>
            <th scope="col" style="color: #ffffff">Короткое описание</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <th scope="row" style="color: #ffffff">
                    {{ $post->title }} <br>

                    <a class="btn btn-primary"
                       href="{{ route('adminPostEdit', $post->id) }}">Редактировать
                    </a>

                    <br>
                </th>

                <td style="color: #ffffff">{{ Str::limit($post->description, 300) }}</td>

                <td>
                    <img class="adminPanel" src="{{ asset('album/images/gallery/'.$post->post_cover)}}"/>
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>


@else
    В блоге еще нету ни одной публикации.
@endif
