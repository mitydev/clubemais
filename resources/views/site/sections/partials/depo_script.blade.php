<script>
(function () {
  const wrap  = document.getElementById('dep-list');
  const track = document.getElementById('depoTrack');
  const thumb = document.getElementById('depoThumb');
  if (!wrap || !track || !thumb) return;

  const gap = () => parseFloat(getComputedStyle(wrap).gap || 0) || 0;
  const step = () => { const c=wrap.querySelector('.depo-card'); return c ? Math.ceil(c.getBoundingClientRect().width + gap()) : Math.ceil(wrap.clientWidth*0.9); };
  const maxScroll = () => Math.max(0, wrap.scrollWidth - wrap.clientWidth);
  const trackW = () => track.clientWidth;

  function updateThumb(){
    const tw=trackW(); const ratio=wrap.clientWidth/wrap.scrollWidth;
    const w=Math.max(60, Math.min(tw, Math.round(tw*ratio)));
    const pos = maxScroll() ? (wrap.scrollLeft / maxScroll()) : 0;
    const x = (tw - w) * pos;
    thumb.style.width = w+'px'; thumb.style.transform = `translateX(${x}px)`;
  }

  let wheelSnapTimer=null;
  wrap.addEventListener('wheel', (e)=>{
    const dx = Math.abs(e.deltaY) >= Math.abs(e.deltaX) ? e.deltaY : e.deltaX;
    if(!dx) return; e.preventDefault();
    const old = wrap.style.scrollSnapType; wrap.style.scrollSnapType='none';
    wrap.scrollLeft += dx; updateThumb();
    clearTimeout(wheelSnapTimer);
    wheelSnapTimer=setTimeout(()=>{ wrap.style.scrollSnapType=old; const i=Math.round(wrap.scrollLeft/step()); wrap.scrollTo({left:i*step(),behavior:'smooth'});},90);
  }, {passive:false});

  let down=false,startX=0,startScroll=0,pid=null;
  wrap.addEventListener('pointerdown',(e)=>{ if(e.target.closest('#depoTrack')) return; down=true; pid=e.pointerId; wrap.setPointerCapture(pid); startX=e.clientX; startScroll=wrap.scrollLeft; wrap.style.scrollSnapType='none';});
  wrap.addEventListener('pointermove',(e)=>{ if(!down) return; wrap.scrollLeft=startScroll-(e.clientX-startX); updateThumb();});
  function endDrag(){ if(!down) return; down=false; try{wrap.releasePointerCapture(pid);}catch{} wrap.style.scrollSnapType=''; const i=Math.round(wrap.scrollLeft/step()); wrap.scrollTo({left:i*step(),behavior:'smooth'}); }
  wrap.addEventListener('pointerup',endDrag); wrap.addEventListener('pointercancel',endDrag); wrap.addEventListener('pointerleave',endDrag);

  track.addEventListener('pointerdown',(e)=>{ if(e.target===thumb) return; const r=track.getBoundingClientRect(); const x=Math.min(Math.max(0,e.clientX-r.left),r.width); const ratio=x/r.width; wrap.scrollTo({left:maxScroll()*ratio,behavior:'smooth'}); });

  let draggingThumb=false,tPid=null,startThumbX=0,startThumbLeft=0;
  function currentThumbLeft(){ const m=getComputedStyle(thumb).transform; if(m&&m!=='none'){ try{ return new DOMMatrixReadOnly(m).m41||0;}catch{return 0;} } return 0; }
  thumb.addEventListener('pointerdown',(e)=>{ draggingThumb=true; tPid=e.pointerId; thumb.setPointerCapture(tPid); startThumbX=e.clientX; startThumbLeft=currentThumbLeft(); wrap.style.scrollSnapType='none'; e.preventDefault(); });
  thumb.addEventListener('pointermove',(e)=>{ if(!draggingThumb) return; const tw=trackW(); const w=thumb.clientWidth; const dx=e.clientX-startThumbX; const left=Math.min(Math.max(0,startThumbLeft+dx),tw-w); thumb.style.transform=`translateX(${left}px)`; const ratio=(tw-w)?(left/(tw-w)):0; wrap.scrollLeft=maxScroll()*ratio; }, {passive:false});
  function endThumbDrag(){ if(!draggingThumb) return; draggingThumb=false; try{thumb.releasePointerCapture(tPid);}catch{} wrap.style.scrollSnapType=''; const i=Math.round(wrap.scrollLeft/step()); wrap.scrollTo({left:i*step(),behavior:'smooth'}); updateThumb(); }
  thumb.addEventListener('pointerup',endThumbDrag); thumb.addEventListener('pointercancel',endThumbDrag); thumb.addEventListener('pointerleave',endThumbDrag);

  wrap.setAttribute('tabindex','0');
  wrap.addEventListener('keydown',(e)=>{ if(e.key!=='ArrowRight'&&e.key!=='ArrowLeft')return; wrap.scrollBy({left:(e.key==='ArrowRight'?step():-step()),behavior:'smooth'}); });

  wrap.addEventListener('scroll', updateThumb, {passive:true}); window.addEventListener('resize', updateThumb);
  requestAnimationFrame(updateThumb);
})();
</script>
