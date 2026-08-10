@extends('layouts.app')

@section('title', 'Accueil')
@section('meta_description', "Le CNEF régule, protège et fait progresser l'économie gabonaise : supervision financière, médiation gratuite, baromètre économique.")

@section('content')
<div id="floating-flag" style="
  position:fixed;bottom:90px;right:28px;z-index:150;
  display:flex;flex-direction:column;gap:0;
  border-radius:6px;overflow:hidden;
  box-shadow:0 4px 16px rgba(0,0,0,.22);
  border:1px solid rgba(255,255,255,.18);
  width:40px;
">
  <div style="height:12px;background:#009A44"></div>
  <div style="height:12px;background:#FCD116"></div>
  <div style="height:12px;background:#003189"></div>
</div>

<div style="background:var(--vert-f);position:relative;overflow:hidden;min-height:calc(100vh - var(--nav));display:flex;flex-direction:column">
  <div class="hcar" id="hero-carousel">
    @foreach ($slides as $i => $slide)
      <div class="hcar-slide {{ $i === 0 ? 'on' : '' }}">
        <img class="hcar-photo" src="{{ asset('assets/images/' . $slide['image']) }}" alt="{{ $slide['alt'] }}">
        <div class="hcar-tag">{{ $slide['tag'] }}</div>
      </div>
    @endforeach
    <div class="hcar-controls">
      <button class="hcar-arrow" onclick="hcarPrev()" aria-label="Précédent"><svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg></button>
      <div class="hcar-dots" id="hcar-dots">
        @foreach ($slides as $i => $slide)
          <button class="hcar-dot {{ $i === 0 ? 'on' : '' }}" onclick="hcarGo({{ $i }})" aria-label="Diapositive {{ $i + 1 }}"></button>
        @endforeach
      </div>
      <button class="hcar-arrow" onclick="hcarNext()" aria-label="Suivant"><svg viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg></button>
    </div>
  </div>

  <div style="flex:1;display:flex;align-items:center;padding:60px 5vw 180px;position:relative;z-index:2">
    <div style="max-width:720px">
      <div class="hero-badge"><span class="hero-dot"></span>Autorité de régulation financière — République Gabonaise</div>
      <h1 class="hero-h1">Réguler, protéger<br>et faire progresser<br>l'économie <em>gabonaise</em></h1>
      <p class="hero-sub">Institué par le Règlement CEMAC N° 03/2019/UMAC/CM du 12 décembre 2019, le CNEF supervise l'ensemble du secteur financier gabonais — banques, établissements de paiement, marchés financiers, assurances et microfinance — protège les consommateurs et accompagne, aux côtés de la BEAC et de la COBAC, la transformation économique du pays.</p>
      <div class="hero-btns">
        <a class="btn-or" href="{{ route('barometre.index') }}">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
          Baromètre économique
        </a>
        <a class="btn-ghost" href="{{ route('mediation.index') }}">Médiation financière — gratuite</a>
      </div>

      <div style="margin-top:36px;padding-top:28px;border-top:1px solid rgba(255,255,255,.1)">
        <p style="font-size:11px;font-weight:500;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:14px">Suivre le CNEF</p>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
          <a href="https://wa.me/24111722000" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:8px;padding:9px 16px;border-radius:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);text-decoration:none;color:#fff">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" fill="#25D366"/><path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.985-1.41A9.955 9.955 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" stroke="#25D366" stroke-width="1.5" fill="none"/></svg>
            <span style="font-size:13px">WhatsApp</span>
          </a>
          <a href="https://www.linkedin.com/company/cnef-gabon" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:8px;padding:9px 16px;border-radius:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);text-decoration:none;color:#fff">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="#0A66C2"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            <span style="font-size:13px">LinkedIn</span>
          </a>
          <a href="https://www.facebook.com/cnefgabon" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:8px;padding:9px 16px;border-radius:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);text-decoration:none;color:#fff">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            <span style="font-size:13px">Facebook</span>
          </a>
          <a href="https://www.youtube.com/@cnef-gabon" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:8px;padding:9px 16px;border-radius:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);text-decoration:none;color:#fff">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="#FF0000"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            <span style="font-size:13px">YouTube</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:2px;padding:0 5vw 50px;position:relative;z-index:2;flex-wrap:wrap">
    @foreach ($stats as $stat)
      <div class="hstat"><div class="hstat-v">{{ $stat['v'] }}</div><div class="hstat-l">{{ $stat['l'] }}</div></div>
    @endforeach
  </div>
</div>

<section style="background:#fff;padding:76px 5vw 60px">
  <div class="stag">Services en un clic</div>
  <h2 class="sh">Accès rapide</h2>
  <p class="si">Retrouvez directement les services, données et ressources les plus consultés du CNEF.</p>
  <div class="quick-grid">
    <a class="quick-card" style="color:var(--vert)" href="{{ route('agrements.index') }}">
      <div class="quick-ico" style="background:var(--vert-c)"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg></div>
      <div class="quick-t">Vérifier un agrément</div>
      <div class="quick-d">Consultez les catégories d'acteurs agréés et la procédure d'instruction d'un dossier.</div>
      <span class="quick-lnk">Consulter les agréments →</span>
    </a>
    <a class="quick-card" style="color:var(--or-d)" href="{{ route('mediation.index') }}">
      <div class="quick-ico" style="background:var(--or-p)"><svg viewBox="0 0 24 24"><path d="M12 3v18M5 7l-3 6a3 3 0 006 0zM19 7l-3 6a3 3 0 006 0zM5 7h14"/></svg></div>
      <div class="quick-t">Saisir le médiateur</div>
      <div class="quick-d">Résolvez gratuitement un litige avec un établissement financier assujetti.</div>
      <span class="quick-lnk">Ouvrir une saisine →</span>
    </a>
    <a class="quick-card" style="color:var(--bleu)" href="{{ route('barometre.index') }}">
      <div class="quick-ico" style="background:var(--bleu-c)"><svg viewBox="0 0 24 24"><path d="M12 20V10M18 20V4M6 20v-4"/></svg></div>
      <div class="quick-t">Baromètre économique</div>
      <div class="quick-d">Suivez en temps réel la santé de l'économie gabonaise, par secteur et branche.</div>
      <span class="quick-lnk">Voir le baromètre →</span>
    </a>
    <a class="quick-card" style="color:var(--vert)" href="{{ route('veille.index') }}">
      <div class="quick-ico" style="background:var(--vert-c)"><svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 016.5 17H20M4 19.5A2.5 2.5 0 006.5 22H20V2H6.5A2.5 2.5 0 004 4.5v15z"/></svg></div>
      <div class="quick-t">Veille réglementaire</div>
      <div class="quick-d">Accédez aux règlements CEMAC, décrets et arrêtés applicables aux acteurs financiers.</div>
      <span class="quick-lnk">Consulter les textes →</span>
    </a>
    <a class="quick-card" style="color:var(--bleu)" href="{{ route('etudes.index') }}">
      <div class="quick-ico" style="background:var(--bleu-c)"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg></div>
      <div class="quick-t">Études &amp; publications</div>
      <div class="quick-d">Consultez les rapports, notes de conjoncture et analyses sectorielles du CNEF.</div>
      <span class="quick-lnk">Voir les publications →</span>
    </a>
    <a class="quick-card" style="color:var(--or-d)" href="{{ route('education.index') }}">
      <div class="quick-ico" style="background:var(--or-p)"><svg viewBox="0 0 24 24"><path d="M22 10L12 5 2 10l10 5 10-5zM6 12v5c0 1.66 2.686 3 6 3s6-1.34 6-3v-5"/></svg></div>
      <div class="quick-t">Éducation financière</div>
      <div class="quick-d">Renforcez votre culture financière avec nos modules pédagogiques gratuits.</div>
      <span class="quick-lnk">Accéder aux modules →</span>
    </a>
  </div>
</section>

<section style="background:var(--bleu-f);padding:76px 5vw;position:relative;overflow:hidden">
  <svg style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;opacity:.5" viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice">
    <defs><pattern id="grd2" width="60" height="60" patternUnits="userSpaceOnUse"><path d="M60 0L0 0 0 60" fill="none" stroke="rgba(232,163,23,0.05)" stroke-width="1"/></pattern></defs>
    <rect width="1200" height="800" fill="url(#grd2)"/>
  </svg>
  <div style="position:relative;z-index:2">
    <div class="stag light">Notre rôle</div>
    <h2 class="sh light">Les missions du CNEF</h2>
    <p class="si light">Quatre missions structurent l'action du Comité National Économique et Financier au service de la stabilité et de l'inclusion financière du Gabon.</p>
    <div class="miss-grid">
      <div class="miss-card">
        <div class="miss-ico"><svg viewBox="0 0 24 24"><path d="M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11M8 10v11M16 10v11M12 10v11"/></svg></div>
        <div class="miss-t">Superviser</div>
        <div class="miss-d">Contrôler l'ensemble des acteurs du secteur financier gabonais et instruire les demandes d'agrément.</div>
      </div>
      <div class="miss-card">
        <div class="miss-ico"><svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
        <div class="miss-t">Réglementer</div>
        <div class="miss-d">Élaborer et diffuser la réglementation applicable, en lien avec la BEAC, la COBAC, la CIMA et la COSUMAF.</div>
      </div>
      <div class="miss-card">
        <div class="miss-ico"><svg viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg></div>
        <div class="miss-t">Analyser</div>
        <div class="miss-d">Publier le baromètre économique et des études pour éclairer la décision publique et privée.</div>
      </div>
      <div class="miss-card">
        <div class="miss-ico"><svg viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
        <div class="miss-t">Protéger &amp; éduquer</div>
        <div class="miss-d">Organiser la médiation financière gratuite et renforcer la culture financière des citoyens.</div>
      </div>
    </div>
  </div>
</section>

<section style="background:#fff;padding:72px 5vw">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;max-width:1100px" class="contact-grid">

    <div>
      <div class="stag">Nous écrire</div>
      <h2 class="sh" style="margin-bottom:12px">Contacter le CNEF par écrit</h2>
      <p style="font-size:14.5px;font-weight:300;color:var(--txt2);line-height:1.75;margin-bottom:28px">Pour toute question relative aux agréments, à la réglementation, aux études économiques ou à la médiation financière, adressez votre courrier au Secrétariat Général du CNEF.</p>

      <form method="POST" action="{{ route('contact.store') }}" style="background:var(--gris);border-radius:var(--rl);padding:28px">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
          <div>
            <label style="display:block;font-size:11.5px;font-weight:500;text-transform:uppercase;letter-spacing:.06em;color:var(--txt3);margin-bottom:6px">Prénom &amp; Nom</label>
            <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Jean-Baptiste Ndong" style="width:100%;padding:10px 13px;border:1px solid var(--gris-m);border-radius:8px;font-size:14px;font-family:'Inter',sans-serif;outline:none;background:#fff">
            @error('nom') <div class="form-error" style="color:#dc2626">{{ $message }}</div> @enderror
          </div>
          <div>
            <label style="display:block;font-size:11.5px;font-weight:500;text-transform:uppercase;letter-spacing:.06em;color:var(--txt3);margin-bottom:6px">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" style="width:100%;padding:10px 13px;border:1px solid var(--gris-m);border-radius:8px;font-size:14px;font-family:'Inter',sans-serif;outline:none;background:#fff">
            @error('email') <div class="form-error" style="color:#dc2626">{{ $message }}</div> @enderror
          </div>
        </div>
        <div style="margin-bottom:14px">
          <label style="display:block;font-size:11.5px;font-weight:500;text-transform:uppercase;letter-spacing:.06em;color:var(--txt3);margin-bottom:6px">Objet</label>
          <select name="objet" style="width:100%;padding:10px 13px;border:1px solid var(--gris-m);border-radius:8px;font-size:14px;font-family:'Inter',sans-serif;outline:none;background:#fff;color:var(--txt)">
            <option value="">— Sélectionnez un objet —</option>
            @foreach (["Demande d'information sur les agréments","Question réglementaire","Demande d'étude ou de publication","Signalement d'un établissement non agréé","Partenariat institutionnel","Éducation financière","Autre"] as $objet)
              <option value="{{ $objet }}" @selected(old('objet') === $objet)>{{ $objet }}</option>
            @endforeach
          </select>
          @error('objet') <div class="form-error" style="color:#dc2626">{{ $message }}</div> @enderror
        </div>
        <div style="margin-bottom:16px">
          <label style="display:block;font-size:11.5px;font-weight:500;text-transform:uppercase;letter-spacing:.06em;color:var(--txt3);margin-bottom:6px">Message</label>
          <textarea name="message" placeholder="Décrivez votre demande…" rows="4" style="width:100%;padding:10px 13px;border:1px solid var(--gris-m);border-radius:8px;font-size:14px;font-family:'Inter',sans-serif;outline:none;background:#fff;resize:vertical">{{ old('message') }}</textarea>
          @error('message') <div class="form-error" style="color:#dc2626">{{ $message }}</div> @enderror
        </div>
        <button type="submit" style="display:flex;align-items:center;gap:8px;background:var(--vert);color:#fff;border:none;border-radius:8px;padding:12px 26px;font-size:14px;font-weight:500;cursor:pointer;font-family:'Inter',sans-serif">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
          Envoyer le message
        </button>
      </form>

      <div style="margin-top:20px;display:flex;align-items:flex-start;gap:12px;padding:16px 18px;background:var(--vert-c);border-radius:var(--r)">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--vert)" stroke-width="2" stroke-linecap="round" style="flex-shrink:0;margin-top:2px"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        <div>
          <div style="font-size:12px;font-weight:500;color:var(--vert);text-transform:uppercase;letter-spacing:.08em;margin-bottom:3px">Adresse postale</div>
          <div style="font-size:13.5px;color:var(--txt2);line-height:1.65">Secrétariat Général du CNEF<br>Direction Nationale de la BEAC<br>Boulevard Triomphal, B.P. 112<br>Libreville — République Gabonaise</div>
        </div>
      </div>
    </div>

    <div>
      <div class="stag">Nous appeler</div>
      <h2 class="sh" style="margin-bottom:12px">Contacts directs</h2>
      <p style="font-size:14.5px;font-weight:300;color:var(--txt2);line-height:1.75;margin-bottom:28px">Le Secrétariat Général et les différents services du CNEF sont joignables aux coordonnées ci-dessous, du lundi au vendredi de 7h30 à 16h30.</p>

      <div style="display:flex;flex-direction:column;gap:14px">
        <div style="background:var(--gris);border-radius:var(--rl);padding:20px 22px">
          <div style="font-size:12px;font-weight:500;color:var(--vert);text-transform:uppercase;letter-spacing:.1em;margin-bottom:14px">Secrétariat Général</div>
          <a href="tel:+24111722000" style="display:flex;align-items:center;gap:12px;margin-bottom:10px;text-decoration:none">
            <div style="width:36px;height:36px;border-radius:8px;background:var(--vert-c);display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--vert)" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.14 1.28 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92v2z"/></svg>
            </div>
            <div>
              <div style="font-size:11px;color:var(--txt3);text-transform:uppercase;letter-spacing:.07em">Téléphone</div>
              <div style="font-size:15px;font-weight:500;color:var(--vert)">+241 11 72 20 00</div>
            </div>
          </a>
          <a href="mailto:contact@cnef.ga" style="display:flex;align-items:center;gap:12px;text-decoration:none">
            <div style="width:36px;height:36px;border-radius:8px;background:var(--vert-c);display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--vert)" stroke-width="2" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div>
              <div style="font-size:11px;color:var(--txt3);text-transform:uppercase;letter-spacing:.07em">Email général</div>
              <div style="font-size:15px;font-weight:500;color:var(--vert)">contact@cnef.ga</div>
            </div>
          </a>
        </div>

        <div style="background:var(--vert-f);border-radius:var(--rl);padding:20px 22px">
          <div style="font-size:12px;font-weight:500;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.1em;margin-bottom:12px">Horaires d'ouverture</div>
          <div style="font-size:14px;color:rgba(255,255,255,.8);line-height:1.75">
            Lundi — Vendredi : <strong style="color:#fff">7h30 — 16h30</strong><br>
            Samedi — Dimanche : <span style="color:rgba(255,255,255,.4)">Fermé</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection
