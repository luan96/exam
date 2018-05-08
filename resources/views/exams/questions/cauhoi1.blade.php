<div id="home" class="tab-pane fade in active">
    <div style="font-size: 22px;">
        <b>
            Câu hỏi 1: 
        </b>
        ({{ $hoi[0]->loaicauhoi }} - {{ $hoi[0]->diem }}đ)
        <input type="hidden" name="" id="macau1" value="{{ $hoi[0]->id }}">
    </div>
    <div class="well" style="width: 100%;">
        <p>
            {{ $hoi[0]->noidung }}
        </p>
    </div>
    <?php 
        $cacphuongan = json_decode($hoi[0]->cacphuongantraloi);
     ?>
    <div class="w5m0">
        @if($hoi[0]->loaicauhoi == Config::get('constants.options.1'))
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                        {{ Form::radio('dapan1[]', '1') }}
                        <span class="ml10">{{ $cacphuongan[0] }}</span>
                    </td>
                    <td>
                        {{ Form::radio('dapan1[]', '2') }}
                        <span class="ml10">{{ $cacphuongan[1] }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ Form::radio('dapan1[]', '3') }}
                        <span class="ml10">{{ $cacphuongan[2] }}</span>
                    </td>
                    <td>
                        {{ Form::radio('dapan1[]', '4') }}
                        <span class="ml10">{{ $cacphuongan[3] }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        @elseif($hoi[0]->loaicauhoi == Config::get('constants.options.2')) 
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                        {{ Form::checkbox('dapan1[]', '1') }}
                        <span class="ml10">{{ $cacphuongan[0] }}</span>
                    </td>
                    <td>
                        {{ Form::checkbox('dapan1[]', '2') }}
                        <span class="ml10">{{ $cacphuongan[1] }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ Form::checkbox('dapan1[]', '3') }}
                        <span class="ml10">{{ $cacphuongan[2] }}</span>
                    </td>
                    <td>
                        {{ Form::checkbox('dapan1[]', '4') }}
                        <span class="ml10">{{ $cacphuongan[3] }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        @elseif($hoi[0]->loaicauhoi == Config::get('constants.options.3')) 
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                        {{ Form::radio('dapan1[]', 'Đúng') }}
                        <span class="ml10">{{ $cacphuongan[0] }}</span>
                    </td>
                    <td>
                        {{ Form::radio('dapan1[]', 'Sai') }}
                        <span class="ml10">{{ $cacphuongan[1] }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        @endif      
    </div>
    <button type="button" class="chuyencauhoi btn btn-info">
        <a data-toggle="tab" href="#1" type="button" id="chuyencauhoi">Chuyển câu hỏi</a>
    </button>

</div>