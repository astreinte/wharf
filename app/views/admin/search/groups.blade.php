@if(count($groups))
        <ul class="data-list">
        	@foreach($groups as $group)
          <li>
        		<h2><a href="{{URL::to('group/'.$group['id'].'/'.Str::slug($group['name']))}}">{{$group['name']}}</a>
           
            @if(count($group['divisions']))

              <?php $n = count($group['divisions']);
              $i = 0; 
              $divisions = '';
              ?>
              @foreach($group['divisions'] as $division)
                <?php $divisions.= '<a href="'.URL::to('division/'.$division['id'].'/'.$division['name']).'">'.$division['name'].'</a>';
                if(++$i != $n) $divisions.= ', ';
                ?>
              @endforeach
              <span class="subtitle">(<?php echo $divisions;?>)</span>

            @endif
            </h2>

            <span class="pull-right"><i class="icon-user"></i> {{count($group['users'])}}</span>
              <p>{{Short::excerpt($group['description'], 14)}}</p>
            @foreach($group['sectors'] as $sector)
              <a href="#" class="tag">{{$sector['name']}}</a>
            @endforeach
          </li>
          @endforeach
        </ul>
@else
<p class="contained noresults">{{Lang::get('messages.no_results')}}</p>
@endif