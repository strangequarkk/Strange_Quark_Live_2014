
<p>$ClientName <% if $Organization %>from $Organization <% end_if %>wants $WorkType from you.</p>
<p>Client's description of the project: 
<br/>$Description
<% if $Budget %><br> Proposed Budget: $Budget <% end_if %>
<% if $Deadline %><br/> Deadline: $Deadline <% end_if %>
<br/>$LeftOut
</p>

