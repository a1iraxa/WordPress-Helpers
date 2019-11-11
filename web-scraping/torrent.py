import libtorrent as lt
import time

ses = lt.session()
ses.listen_on(6881, 6891)
params = {
    'save_path': '/home/downloads/',
    'storage_mode': lt.storage_mode_t(2),
    'paused': False,
    'auto_managed': True,
    'duplicate_is_error': True}
link = 'magnet:?xt=urn:btih:5AF7D8E3F0E62B762121EC03BDD0073C46DB1415&dn=TE3N+2016+Hindi+720p+DvDRip+x264+AAC+-+Hon3y+%5BExclusive%5D&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.aletorrenty.pl%3A2710%2Fannounce&tr=udp%3A%2F%2Fp4p.arenabg.ch%3A1337%2Fannounce&tr=udp%3A%2F%2Fthetracker.org%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.sktorrent.net%3A6969%2Fannounce&tr=udp%3A%2F%2F9.rarbg.me%3A2710%2Fannounce&tr=udp%3A%2F%2F9.rarbg.to%3A2710%2Fannounce&tr=udp%3A%2F%2Fzer0day.ch%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2Fexplodie.org%3A6969%2Fannounce&tr=udp%3A%2F%2Fp4p.arenabg.com%3A1337&tr=udp%3A%2F%2Ftorrent.gresille.org%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2Fcoppersurfer.tk%3A6969%2Fannounce'
handle = lt.add_magnet_uri(ses, link, params)
ses.start_dht()

print('downloading metadata...')
while (not handle.has_metadata()):
    time.sleep(1)
print( 'got metadata, starting torrent download...' )
while (handle.status().state != lt.torrent_status.seeding):
    s = handle.status()
    state_str = ['queued', 'checking', 'downloading metadata', \
                'downloading', 'finished', 'seeding', 'allocating']
    print ('%.2f%% complete (down: %.1f kb/s up: %.1f kB/s peers: %d) %s %.3' % \
                (s.progress * 100, s.download_rate / 1000, s.upload_rate / 1000, \
                s.num_peers, state_str[s.state], s.total_download/1000000) )
    time.sleep(5)