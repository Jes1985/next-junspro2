/**
 * JunsPro — Service Worker Ritual Alarm
 * Sonne 15 minutes avant le prochain Rituel, même onglet fermé.
 * Version : 1.0 — 2026-03-02
 */

const ALARM_KEY = 'ritual_alarm';
let scheduledTimer = null;

/* ─── Réception message depuis la page ─── */
self.addEventListener('message', (event) => {
  if (!event.data) return;

  if (event.data.type === 'SCHEDULE_RITUAL_ALARM') {
    const { startAt, freelancerName, dashboardUrl } = event.data;
    scheduleAlarm(startAt, freelancerName, dashboardUrl);
  }

  if (event.data.type === 'CANCEL_RITUAL_ALARM') {
    if (scheduledTimer) clearTimeout(scheduledTimer);
    scheduledTimer = null;
  }
});

/* ─── Re-programme l'alarme à chaque activation du SW ─── */
self.addEventListener('activate', (event) => {
  event.waitUntil(clients.claim());
});

/* ─── Logique principale ─── */
function scheduleAlarm(startAt, freelancerName, dashboardUrl) {
  if (scheduledTimer) clearTimeout(scheduledTimer);

  const startMs    = new Date(startAt).getTime();
  const alertAt    = startMs - 15 * 60 * 1000; // 15 min avant
  const delay      = alertAt - Date.now();
  const name       = freelancerName || 'votre participant';
  const url        = dashboardUrl || '/user/account/dashboard';

  if (delay > 0) {
    /* Alarme future → programmer */
    scheduledTimer = setTimeout(() => fireNotification(name, startAt, false, url), delay);
  } else if (Date.now() < startMs) {
    /* Déjà dans la fenêtre de 15 min → sonner immédiatement */
    fireNotification(name, startAt, true, url);
  }
  /* sinon : rituel déjà passé → rien */
}

function fireNotification(freelancerName, startAt, immediate = false, dashboardUrl = '/user/account/dashboard') {
  const startDate = new Date(startAt);
  const hh = String(startDate.getHours()).padStart(2, '0');
  const mm = String(startDate.getMinutes()).padStart(2, '0');
  const timeStr = `${hh}:${mm}`;

  const title = immediate
    ? `🔔 Rituel dans moins de 15 min — ${timeStr}`
    : `🔔 Rituel dans 15 minutes — ${timeStr}`;

  const body = `Votre session avec ${freelancerName} commence à ${timeStr}. Préparez-vous !`;

  self.registration.showNotification(title, {
    body,
    icon:             '/assets/img/logo.png',
    badge:            '/assets/img/logo.png',
    vibrate:          [300, 150, 300, 150, 600],
    requireInteraction: true,
    tag:              'ritual-alarm',
    renotify:         true,
    data:             { url: dashboardUrl },
    actions: [
      { action: 'open',    title: '📅 Voir le Rituel' },
      { action: 'dismiss', title: 'Fermer' },
    ],
  });
}

/* ─── Clic sur la notification → ouvre le dashboard ─── */
self.addEventListener('notificationclick', (event) => {
  event.notification.close();

  if (event.action === 'dismiss') return;

  const targetUrl = event.notification.data?.url || '/user/account/dashboard';
  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then((list) => {
      for (const client of list) {
        if (client.url.includes(targetUrl) && 'focus' in client) {
          return client.focus();
        }
      }
      return clients.openWindow(targetUrl);
    })
  );
});
