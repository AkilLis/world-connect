@extends('layouts.index-layout', ['currentView' => 'information-view'])
@section('content') 
	<section class="content" v-cloak>
		<div class="cntr-fluid margin-vertical">
			<div class="feed-container mini">
				<div class="feed-title">
					Мэдээ, Мэдээлэлүүд
				</div>

				<div class="no-hover content-container @{{ $index != 0 ? 'small' : ''}}" v-for="news in information">
						<div class="cover-cntr">
							<div class="cover">
								<div class="cover-img">
									<img class="horizontal" :src="news.cover_url"/>
								</div>
							</div>
						</div>
						<div class="content">
							<div class="content-title">
								<a :href="'/news/' + news.id">@{{news.title}}</a>
								<label class="date">
									@{{news.created_at | moment 'from'}}
								</label>
							</div>
							<div class="content-description">
								@{{news.info[0].description}}
							</div>
							<div class="content-info">
								<div class="row">
									<div class="col-xs-12 text-right">
										<span class="view">
											<i class="fa fa-eye"></i> @{{news.visit_count}}
										</span>
										<span class="news-type">
											@{{news.type | newsFilter}}
										</span>
									</div>	
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
		<paginate :paginate="3" 
		          v-ref:paginate
		          :total.sync="total"
		          @page-changed="pageChanged"
		            >
		</paginate>
	</section>
@stop