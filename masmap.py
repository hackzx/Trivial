# coding=u8
import sys
import os
import socket

ip = sys.argv[1]
ip = ip.replace('http://', '').replace('https://', '').replace('/', '')

def domain2ip(domain):
    try:
        return socket.gethostbyname(domain)
    except:
        return 0

def masscan(ip):
        for x in xrange(0,3):
                # os.system('masscan -p1-65535 --rate=10000 -oL {tmp} {ip}'.format(tmp='/tmp/tmp_result_'+str(x),ip=ip))
                os.system('/opt/masscan/bin/masscan -p1-65535 --wait 1 --rate=10000 -oG {tmp} {ip}'.format(tmp='/tmp/tmp_result_'+str(x),ip=ip))

def selectPorts():
        os.system('cat /tmp/tmp_result_0 /tmp/tmp_result_1 /tmp/tmp_result_2 | sort | uniq > /tmp/tmp_result')
        os.system('sed -i \'/#/d\' /tmp/tmp_result')
        os.system('cat /tmp/tmp_result')
        ports=''
        with open('/tmp/tmp_result') as f:
                for line in f:
                        if ports != '':
                                ports += ','
                        port = line.split()
                        ports += port[4].replace('/','').replace('open','').replace('tcp','')
        return ports


def nmap(ip,ports):
        os.system('nmap -Pn -T5 -sV -A {ip} -p{ports} -oN result'.format(ip=ip,ports=ports))

ip = domain2ip(ip)

if __name__ == '__main__':
        print 'IP: '+ip
        masscan(ip)
        ports=selectPorts()
        nmap(ip,ports)
