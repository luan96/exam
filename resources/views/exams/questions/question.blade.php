{{ Form::open() }}
<div>
  <!-- <div class="tab-content">
    @for ($i=0; $i < count($hoi); $i++)
      <div id="{{ $i }}" @if($i==0)
                       class="tab-pane fade in active"
                       @elseif($i!=0)
                       class="tab-pane fade"
                       @endif >
        <div style="font-size: 22px;">
          <b>
            Câu hỏi {{ $i+1 }}: 
          </b>
          ({{ $hoi[$i]->loaicauhoi }} - {{ $hoi[$i]->diem }}đ)
          <input type="hidden" class="macauhoi" value="{{ $hoi[$i]->id }}">
        </div>
        <div class="well" style="width: 100%;">
          <p>
            {{ $hoi[$i]->noidung }}
          </p>
        </div>
        <?php
        $cacphuongan1 = json_decode($hoi[$i]->cacphuongantraloi);
        $j = $i + 1;
        $forms = 'dapan' . $j;
        $form = $forms . '[]';
        ?>
        <div class="w5m0">
          @if($hoi[$i]->loaicauhoi == Config::get('constants.options.1'))
            <table class="w100pt">
              <tbody>
                <tr>
                  <td>
                    {{ Form::radio($form, '1') }}
                    <span class="ml10">{{ $cacphuongan1[0] }}</span>
                  </td>
                  <td>
                    {{ Form::radio($form, '2') }}
                    <span class="ml10">{{ $cacphuongan1[1] }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    {{ Form::radio($form, '3') }}
                    <span class="ml10">{{ $cacphuongan1[2] }}</span>
                  </td>
                  <td>
                    {{ Form::radio($form, '4') }}
                    <span class="ml10">{{ $cacphuongan1[3] }}</span>
                  </td>
                </tr>
              </tbody>
            </table>
          @elseif($hoi[$i]->loaicauhoi == Config::get('constants.options.2'))
            <table class="w100pt">
              <tbody>
                <tr>
                  <td>
                    {{ Form::checkbox($form, '1') }}
                    <span class="ml10">{{ $cacphuongan1[0] }}</span>
                  </td>
                  <td>
                    {{ Form::checkbox($form, '2') }}
                    <span class="ml10">{{ $cacphuongan1[1] }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    {{ Form::checkbox($form, '3') }}
                    <span class="ml10">{{ $cacphuongan1[2] }}</span>
                  </td>
                  <td>
                    {{ Form::checkbox($form, '4') }}
                    <span class="ml10">{{ $cacphuongan1[3] }}</span>
                  </td>
                </tr>
              </tbody>
            </table>
          @elseif($hoi[$i]->loaicauhoi == Config::get('constants.options.3'))
            <table style="width: 100%;">
              <tbody>
                <tr>
                  <td>
                    {{ Form::radio($form, 'Đúng') }}
                    <span class="ml10">{{ $cacphuongan1[0] }}</span>
                  </td>
                  <td>
                    {{ Form::radio($form, 'Sai') }}
                    <span class="ml10">{{ $cacphuongan1[1] }}</span>
                  </td>
                </tr>
              </tbody>
            </table>
          @endif
        </div>
        <a type="button" class="chuyencauhoi btn btn-info" data-toggle="tab" href="#{{ $i+1 }}"          @if($i == (count($hoi)-1))
                  style="display: none;"
                  @endif >
                Chuyển câu hỏi
        </a>
      </div>
    @endfor
  </div> -->

  <div id="rootwizard">
    <div class="navbar">
      <div class="navbar-inner">
        <ul>
          @for ($i=0; $i < count($hoi); $i++)
            <li class="next-tab">
              <a href="#{{ $i }}" data-toggle="tab" class="chuyencauhoi">
                {{ $i+1 }}
              </a>
            </li>
          @endfor
        </ul>
      </div>
    </div>
    <div class="tab-content">
      @for ($i=0; $i < count($hoi); $i++)
        <div id="{{ $i }}" class="tab-pane">
          <div style="font-size: 22px;">
            <b>
              Câu hỏi {{ $i+1 }}:
            </b>
            ({{ $hoi[$i]->loaicauhoi }} - {{ $hoi[$i]->diem }}đ)
            <input type="hidden" class="macauhoi" value="{{ $hoi[$i]->id }}">
          </div>
          <div class="w100pt well">
            <p>
              {!! $hoi[$i]->noidung !!}
            </p>
          </div>
          <?php
          $cacphuongan1 = json_decode($hoi[$i]->cacphuongantraloi);
          $j = $i + 1;
          $forms = 'dapan' . $j;
          $form = $forms . '[]';
          ?>
          <div class="w5m0">
            @if($hoi[$i]->loaicauhoi == Config::get('constants.options.1'))
              <table class="w100pt">
                <tbody>
                <tr>
                  <td>
                    {{ Form::radio($form, '1') }}
                    <span class="ml10">{{ $cacphuongan1[0] }}</span>
                  </td>
                  <td>
                    {{ Form::radio($form, '2') }}
                    <span class="ml10">{{ $cacphuongan1[1] }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    {{ Form::radio($form, '3') }}
                    <span class="ml10">{{ $cacphuongan1[2] }}</span>
                  </td>
                  <td>
                    {{ Form::radio($form, '4') }}
                    <span class="ml10">{{ $cacphuongan1[3] }}</span>
                  </td>
                </tr>
                </tbody>
              </table>
            @elseif($hoi[$i]->loaicauhoi == Config::get('constants.options.2'))
              <table class="w100pt">
                <tbody>
                <tr>
                  <td>
                    {{ Form::checkbox($form, '1') }}
                    <span class="ml10">{{ $cacphuongan1[0] }}</span>
                  </td>
                  <td>
                    {{ Form::checkbox($form, '2') }}
                    <span class="ml10">{{ $cacphuongan1[1] }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    {{ Form::checkbox($form, '3') }}
                    <span class="ml10">{{ $cacphuongan1[2] }}</span>
                  </td>
                  <td>
                    {{ Form::checkbox($form, '4') }}
                    <span class="ml10">{{ $cacphuongan1[3] }}</span>
                  </td>
                </tr>
                </tbody>
              </table>
            @elseif($hoi[$i]->loaicauhoi == Config::get('constants.options.3'))
              <table class="w100pt">
                <tbody>
                <tr>
                  <td>
                    {{ Form::radio($form, 'Đúng') }}
                    <span class="ml10">{{ $cacphuongan1[0] }}</span>
                  </td>
                  <td>
                    {{ Form::radio($form, 'Sai') }}
                    <span class="ml10">{{ $cacphuongan1[1] }}</span>
                  </td>
                </tr>
                </tbody>
              </table>
            @endif
          </div>
        </div>
      @endfor
      <ul class="pager wizard">
        <li class="previous first" style="display: none"><a href="#">First</a></li>
        <li class="previous"><a href="#">Previous</a></li>
        <li class="next last" style="display: none"><a href="#">Last</a></li>
        <li class="next chuyencauhoi"><a href="#">Next</a></li>
      </ul>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#rootwizard').bootstrapWizard();
    });
  </script>


  <hr class="question-hr">
  <div class="submit">
    <p class="text-center">
      {{ Form::submit('Hoàn thành',['id'=>'btn_finish']) }}
    </p>
  </div>
</div>
{{ Form::close() }}