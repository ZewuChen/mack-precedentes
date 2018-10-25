@extends ('app')

@section ('content')

    <h2 class="mp-heading">Patrono Acadêmico</h2>
    
    <div class="py-4">
    	<h5 class="text-center"><strong>Professor Doutor Titular Luiz Guilherme Marinoni</strong></h5>

		<div>
            <img width="300" class="img-responsive img-thumbnail rounded mx-auto d-block" src="{{ asset('img/team/marinoni.jpg') }}">
        </div>
        <br>

        <div>
            <p>Professor Titular (com defesa de tese) de Direito Processual Civil da Faculdade de Direito da Universidade Federal do Paraná. Pós-Doutor pela Universidade Estatal de Milão,  pela Columbia University e pela Fordham University. É Professor Visitante em várias Universidades da América Latina e da Europa. Diretor do Instituto Iberoamericano de Derecho Procesal e membro do Conselho da International Association of Procedural Law. Publicou mais de trinta livros. Os seus livros foram traduzidos para mais de dez países, na América Latina e na Europa. Foi indicado como finalista para o Prêmio Jabuti cinco vezes, tendo recebido o prêmio duas vezes.</p>
        </div>
        <ul>
        	<li>
        		<a href="{{ asset('docs/coisa-julgada-e-precedentes.pdf') }}" download>Coisa Julgada sobre Questão em Favor de Terceiros e Precedentes Obrigatórios</a>
        	</li>
        	<li>
        		<a href="{{ asset('docs/cultura-e-previsibilidade-do-direito.pdf') }}" download>Cultura e Previsibilidade do Direito</a>
        	</li>
        	<li>
        		<a href="{{ asset('docs/decisao-do-recurso-e-instituicao-do-precedente-no-supremo-tribunal-federal.pdf') }}" download>Decisão do Recurso e Instituição do Precedente no Supremo Tribunal Federal</a>
        	</li>
        	<li>
        		<a href="{{ asset('docs/o-problema.pdf') }}" download>O “PROBLEMA” do incidente de resolução de demandas repetitivas</a>
        	</li>
        	<li>		
				<a href="{{ asset('docs/o-precedente-interpretativo-como-resposta-a-transformacao-do-civil-law.pdf') }}" download>O Precedente interpretativo como resposta à transformação do CIVIL LAW </a>
        	</li>
        </ul>
    </div>

@endsection

